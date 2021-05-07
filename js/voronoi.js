//fork from https://codepen.io/jhancock532/details/eYZyEEW

//// ---- DAT.GUI CODE ---- ////
let params = { 
    horizontalVoronoiDivisions: 7,
    verticalVoronoiDivisions: 9,
    voronoiIrregularity: 0.2,
    innerShapes: 6,
    innerShapeAngle: 0.02,
    shadeVariance: 0.07,
    lineThickness: 0.6,
    hueStart: 0,
    hueEnd: 90,
    brightness: 95,
    saturation: 100,
    offset: -80,
    animationSpeed: 500,
    animate: true,
    hideText: true,
    createNew: function(){
      resetVoronoiDesign();
    },
  }
  
  /*
  let gui = new dat.GUI();
  
  let voronoiFolder = gui.addFolder("Voronoi Diagram");
  let sketchFolder = gui.addFolder("Sketch Overlay");
  let colourFolder = gui.addFolder("Colours");
  
  voronoiFolder.add(params, "horizontalVoronoiDivisions", 1, 20, 1).name("Horiz. Divisions").onChange(function() {
      resetVoronoiDesign();
  });
  voronoiFolder.add(params, "verticalVoronoiDivisions", 1, 20, 1).name("Vert. Divisions").onChange(function() {
      resetVoronoiDesign();
  });
  voronoiFolder.add(params, "voronoiIrregularity", 0, 0.5).name("Irregularity").onChange(function() {
      resetVoronoiDesign();
  });
  sketchFolder.add(params, "innerShapes", 0, 30, 1).name("Inner Shapes").onChange(function() {
      renderVoronoiDesign();
  });
  sketchFolder.add(params, "innerShapeAngle", 0, 1).name("Inner Angle").onChange(function() {
      renderVoronoiDesign();
  });
  sketchFolder.add(params, "lineThickness", 0, 5).name("Thickness").onChange(function() {
      renderVoronoiDesign();
  });
  
  colourFolder.add(params, "shadeVariance", 0, 0.99).name("Hue Variance").onChange(function() {
    renderVoronoiDesign();
  });
  colourFolder.add(params, "hueStart", -30, 360, 1).name("Hue Start").onChange(function() {
      renderVoronoiDesign();
  });
  colourFolder.add(params, "hueEnd", 0, 390, 1).name("Hue End").onChange(function() {
      renderVoronoiDesign();
  });
  colourFolder.add(params, "saturation", 0, 100, 1).name("Saturation").onChange(function() {
      renderVoronoiDesign();
  });
  colourFolder.add(params, "brightness", 0, 100, 1).name("Brightness").onChange(function() {
      renderVoronoiDesign();
  });
  colourFolder.add(params, "offset", -100, 100, 1).name("Edge Offset").onChange(function() {
      renderVoronoiDesign();
  });
  
  gui.add(params, "hideText").name("Hide Text").onChange(function() {
      renderVoronoiDesign();
  });
  
  gui.add(params, "animate").name("Animate");
  
  gui.add(params, "createNew").name("Generate New Design");
  */
  
  let delaunay, voronoi, polygons, voronoiPoints, scaledVoronoiPoints, shapes;
  
  function setup(){
    createCanvas(windowWidth, windowHeight); 
    //colorMode(HSB, 360, 100, 100, 1); 
    colorMode(HSB, 205, 44, 84, 1); 
    rectMode(CENTER);
    
    textSize(22);
    textAlign(CENTER);
    textStyle(BOLD);
    textFont('Courier New');
    
    resetVoronoiDesign();
  }
  
  function windowResized() {
    resizeCanvas(windowWidth, windowHeight);
    renderVoronoiDesign();
  }
  
  function renderVoronoiDesign(){
    scaleVoronoiPoints();
    createVoronoiPolygons();
    createShapes();
    drawShapes();
    
    if (params.hideText == false){
      drawText();
    }
  }
  
  function resetVoronoiDesign(){
    noiseSeed(frameCount);
    createVoronoiPoints();
    renderVoronoiDesign();
  }
  
  function createVoronoiPoints(){
    voronoiPoints = [];
    //The following code is derived from this StackOverflow answer
    //https://stackoverflow.com/questions/3667927/do-randomly-generated-2d-points-clump-together-and-how-do-i-stop-it
    let randomnessFactor = params.voronoiIrregularity;
  
    for (let ySubDivisions = 0; ySubDivisions < params.verticalVoronoiDivisions; ++ySubDivisions){
      for (let xSubDivisions = 0; xSubDivisions < params.horizontalVoronoiDivisions; ++xSubDivisions){
        let regularity = 0.5 * (1 - randomnessFactor);
        let x = regularity + randomnessFactor * random(0, 1) + xSubDivisions / (params.horizontalVoronoiDivisions - 1);
        let y = regularity + randomnessFactor * random(0, 1) + ySubDivisions / (params.verticalVoronoiDivisions - 1);
        voronoiPoints.push([x - 0.5, y - 0.5]);
      }
    }
  }
  
  function scaleVoronoiPoints(){
    scaledVoronoiPoints = [];
    for (let i = 0; i < voronoiPoints.length; i++){
      scaledVoronoiPoints.push([voronoiPoints[i][0] * windowWidth, voronoiPoints[i][1] * windowHeight]);
    }
  }
  
  function createVoronoiPolygons(){
    delaunay = d3.Delaunay.from(scaledVoronoiPoints);
    voronoi = delaunay.voronoi([0, 0, windowWidth, windowHeight]);
    polygons = voronoi.cellPolygons();
  }
  
  function drawText(){
    noStroke();
    fill(250);
    rect(windowWidth / 2 - 1, windowHeight - 33, 226, 30)
    fill(0);
    text("VORONOI SKETCHES", windowWidth / 2, windowHeight - 26);
  }
  
  function createShapes(){
    shapes = [];
    for (const cell of polygons){
      if (cell.index % 1 == 0){
        shapes.push(new RecursiveShape(cell.length - 1, cell));
        shapes[shapes.length - 1].generateShapePoints();
      }
    }
  }
  
  function draw(){
    if (params.animate == true){
      if (frameCount % 2 == 0){
        let innerShapeAngle = lerp(0, 0.1, (sin(frameCount/100) + 1) / 2);
  
        for (let i = 0; i < shapes.length; i++){
          shapes[i].innerShapeRotation = innerShapeAngle;
          shapes[i].generateShapePoints();
          shapes[i].draw();
        }
  
        if (params.hideText == false){
          drawText();
        }
      }
    }
  }
  
  function drawShapes(){
    background(0);
    for (const shape of shapes){
      shape.draw();
    }
  }
  
  function RecursiveShape(shapeSides, shapePoints){
    this.baseShapePoints = shapePoints.map((x) => x);
    this.numberOfShapeSides = shapeSides;
    this.shapePoints = [];
    this.numberOfInnerShapes = params.innerShapes;
    this.innerShapeRotation = params.innerShapeAngle;
    
    this.generateShapePoints = function() {
      this.shapePoints = this.baseShapePoints.map((x) => x);
      for (let i = 0; i < this.numberOfInnerShapes; i++){
        for (let j = 0; j < this.numberOfShapeSides; j++){
          let firstPoint = this.shapePoints[i * (this.numberOfShapeSides + 1) + j];
          let secondPoint = this.shapePoints[i * (this.numberOfShapeSides + 1) + ((j + 1) % this.numberOfShapeSides)];
          let xPosition = lerp(firstPoint[0], secondPoint[0], this.innerShapeRotation);
          let yPosition = lerp(firstPoint[1], secondPoint[1], this.innerShapeRotation);
          this.shapePoints.push([xPosition, yPosition]);
        }
        this.shapePoints.push([this.shapePoints[i * (this.numberOfShapeSides + 1) + (this.numberOfShapeSides + 1)][0], this.shapePoints[i * (this.numberOfShapeSides + 1) + (this.numberOfShapeSides + 1)][1]]);
      }
    }
    
    this.draw = function() {
      strokeWeight(params.lineThickness);
      
      let intensity = noise(this.shapePoints[0][0] / (windowWidth * (1 - params.shadeVariance)), this.shapePoints[0][1] / (windowHeight * (1 - params.shadeVariance)), frameCount / params.animationSpeed);
      
      let cellColour = color(lerp(params.hueStart, params.hueEnd, intensity), params.saturation, params.brightness);
      let strokeColour = color(lerp(params.hueStart, params.hueEnd, intensity), params.saturation, params.brightness + params.offset);
      
      fill(cellColour);
      stroke(strokeColour);
      
      beginShape();
      for (let i = 0; i < this.shapePoints.length; i++){
        vertex(this.shapePoints[i][0], this.shapePoints[i][1]);
      }
      endShape();
      
      noFill();
  
      for (let i = 0; i < this.numberOfInnerShapes + 1; i++){
        for (let j = 0; j < this.numberOfShapeSides + this.numberOfInnerShapes; j++){
          line(this.shapePoints[i * this.numberOfShapeSides + j][0], this.shapePoints[i * this.numberOfShapeSides + j][1], this.shapePoints[i * this.numberOfShapeSides + j + 1][0], this.shapePoints[i * this.numberOfShapeSides + j + 1][1]);
        }
      }
    }
  }
  
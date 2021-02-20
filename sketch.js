
let walls = [];
let ray;
let particles = [];
let xoff = [100, 200, 300];
let yoff = [300, 600, 1000];

function setup() {
    var cnv = createCanvas(windowWidth, windowHeight);
    cnv.parent('sketch-holder'); //스케치가 html의 '#sketch-holder'에 들어갑니다. p5.js 에디터에서는 삭제.
    background(255);
    for (let i = 0; i < 30; i++) {
        let x1 = random(width);
        let x2 = random(width);
        let y1 = random(height);
        let y2 = random(height);
        walls[i] = new Boundary(x1, y1, x2, y2);
    }

    

    // walls.push(new Boundary(0, 0, width, 0));
    // walls.push(new Boundary(width, 0, width, height));
    // walls.push(new Boundary(width, height, 0, height));
    // walls.push(new Boundary(0, height, 0, 0));

    particles[0] = new Particle(8, 247, 254);
    // particles[] = new Particle(9, 251, 211);
    particles[1] = new Particle(242, 83, 187);
    particles[2] = new Particle(245, 211, 0);

    // particle = new Particle(random(width), random(height));

    for (let i = 0; i < 3; i++) {
        particles[i].update(width/2, height/2);
    }
}

function draw() {
    // walls[0] = new Boundary(0, mouseY, width, mouseY);
    // walls[1] = new Boundary(mouseX, 0, mouseX, height);
    var mval = map(mouseX, 0, width, 30, 0);
    background(255,1.4);
    for (let wall of walls) {
        wall.show();
    }

    particles[0].look(walls, random(8,242), 247, 254);
    particles[1].look(walls, 242, random(83, 211), 187);
    particles[2].look(walls, 245, 211, random(0, 254));

    for (let i = 0; i < 3; i++) {

        // particle.show();
        

        xoff[i] += 0.01;
        yoff[i] += 0.01;

        particles[i].update(noise(xoff[i]) * width, noise(yoff[i]) * height);
    }

    // particles[3].look(walls);
    // particles[3].update(mouseX, mouseY);

    // ray.show();
    // ray.lookAt(mouseX, mouseY);

    // let pt = ray.cast(wall);

    // if (pt) {
    //     fill(0);
    //     ellipse(pt.x, pt.y, 5, 5);
    // }
}

function windowResized() {
    resizeCanvas(windowWidth, windowHeight);
  }
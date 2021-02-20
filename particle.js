class Particle {
    constructor(_r, _g, _b) {
        this.r = _r;
        this.g = _g;
        this.b = _b;
        this.pos = createVector();
        this.rays = [];
        for (let a = 0; a < 360; a += 1) {
            this.rays.push(new Ray(this.pos, radians(a)));

        }
    }

    update(x, y) {
        this.pos.set(x, y);
    }

    look(walls, r, g, b) {
        for (let ray of this.rays) {
            stroke(r, g, b, random(100));
            let closest = null;
            let record = Infinity;
            for (let wall of walls) {
                const pt = ray.cast(wall);
                if (pt) {
                    const d = p5.Vector.dist(this.pos, pt);
                    if (d < record) {
                        record = d;
                        closest = pt;
                    }
                }
            }
            if (closest) {
                
                line(this.pos.x, this.pos.y, closest.x, closest.y);
            }
        }

    }

    show() {
        // fill(0);
        // ellipse(this.pos.x, this.pos.y, 4);
        // for (let lay of this.rays) {
        // ray.show();

        // }
    }
}
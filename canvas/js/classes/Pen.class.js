'use strict';

class Pen {
    constructor(color, size) {

        this.color = 'black';
        this.size = 2;
    }

    setColor(color) {
        this.color = color;
    }
    setSize(size) {

        this.size = size;
    }
    configure(slateCanvasContext) {

        slateCanvasContext.lineWidth = this.size;
        slateCanvasContext.strokeStyle = this.color;


    }
}

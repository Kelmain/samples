'use strict';


class Slate {
    constructor(pen) {
        this.pen = pen;
        this.isDrawing = false;
        this.currentLocation = null;
        /* this.canvas = $('#slate')[0];*/
        this.canvas = document.getElementById('slate');
        this.context = this.canvas.getContext('2d');
        this.canvas.addEventListener('mousedown', this.onMouseDown.bind(this));
        this.canvas.addEventListener('mousemove', this.onMouseMovement.bind(this));
        this.canvas.addEventListener('mouseup', this.onMouseUp.bind(this));
        this.canvas.addEventListener('mouseleave', this.onMouseUp.bind(this));



    }

    clear(event) {


        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);

    }


    getMouseposition(event) {


        var location;
        var rectangle;



        rectangle = this.canvas.getBoundingClientRect();

        location = {
            posX: event.clientX - rectangle.left,
            posY: event.clientY - rectangle.top

        };

        return location;


    }


    onMouseDown(event) {
        this.isDrawing = true;
        this.currentLocation = this.getMouseposition(event);


    }
    onMouseMovement(event) {
        if (this.isDrawing === true) {

            var coords = this.getMouseposition(event);

            this.context.beginPath();
            this.context.moveTo(this.currentLocation.posX, this.currentLocation.posY);
            this.pen.configure(this.context);
            this.context.lineTo(coords.posX, coords.posY);
            this.context.lineJoin = this.context.lineCap = 'round';

            this.context.stroke();
            this.currentLocation = coords;


        }
    }





    onMouseUp(event) {

        this.isDrawing = false;

    }

}

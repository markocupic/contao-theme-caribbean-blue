import Headroom from "headroom.js";

// grab an element
const header = document.getElementById("header");

const options = {
    offset: {
        up: 200,
        down: 200
    },
};

// construct an instance of Headroom, passing the element
const headroom = new Headroom(header, options);

// initialise
headroom.init();

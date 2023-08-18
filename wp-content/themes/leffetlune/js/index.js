"use strict";
import { Background } from "./background.js";
import { Navigation } from "./navigation.js";
try {
    new Background("canvas#background");
    new Navigation("nav#header-navigation");
}
catch (e) {
    console.error(e);
}

"use strict";
import { Background } from "./background.js";
import { Footer } from "./footer.js";
import { Header } from "./header.js";
import { Navigation } from "./navigation.js";
try {
    new Background("canvas#background");
    new Header("header.header", "main.content", "close");
    new Navigation("nav#header-navigation", ".menu", ":scope > li.menu-item", "button.burger", "open", "right");
    new Footer("footer#footer", "span.footer-button", "open");
}
catch (e) {
    console.error(e);
}

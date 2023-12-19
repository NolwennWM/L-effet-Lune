"use strict";
import { Background } from "./background.js";
import { Footer } from "./footer.js";
import { Header } from "./header.js";
import { Navigation } from "./navigation.js";

try
{
    new Background("canvas#background");
    new Header("header .header-content", "main.content", "close");
    new Navigation("nav#header-navigation", ".menu", ":scope > li.menu-item", "button.burger", "open", "right");
    new Footer("footer#footer", "span.footer-button", "open");
    const sliders = document.querySelectorAll<HTMLElement>(".slider");
    if(sliders.length)
    {
        getSlider(sliders);
    }
    
}
catch(e)
{
    console.error(e);
}

async function getSlider(sliders:NodeListOf<HTMLElement>)
{
    const impSlider = await import("./slider.js");
    sliders.forEach(sl=>{
        new impSlider.Slider(sl);
    })
}
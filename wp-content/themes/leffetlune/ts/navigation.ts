"use strict";

export class Navigation
{
    private navigation: HTMLElement|null;
    private burgerBtn: HTMLButtonElement|null = null;
    private menu: HTMLDivElement|null = null;
    private menuItems: NodeListOf<HTMLLIElement>|null = null;

    private open: boolean = false;
    private angle: number = 0;

    constructor(selector: string)
    {
        this.navigation = document.querySelector(selector);
        if(!this.navigation)
        {
            console.error(`Élément de navigation "parent" introuvable`);
            return;
        }
        this.menu = this.navigation.querySelector("div.menu");
        if(!this.menu)
        {
            console.error(`Élément de navigation "menu" introuvable`);
            return;
        }
        this.menuItems = this.menu.querySelectorAll("ul li.page_item");
        this.burgerBtn = this.navigation.querySelector("button.burger");
        if(!this.menuItems.length || !this.burgerBtn)
        {
            console.error(`Élément de navigation "burger" ou "li" introuvable`);
            return;
        }
        this.angle = 360 / this.menuItems.length;
        this.setting();        
    }

    setting()
    {
        if(!this.burgerBtn || !this.menu || !this.menuItems)return;

        this.toggleMenu = this.toggleMenu.bind(this);
        this.closeMenu = this.closeMenu.bind(this);
        this.bloomMenu = this.bloomMenu.bind(this);
        this.witherMenu = this.witherMenu.bind(this);

        const lastItem = this.menuItems[this.menuItems.length -1];

        this.burgerBtn.addEventListener("pointerdown", this.toggleMenu);
        this.menu.addEventListener("pointerdown", this.witherMenu);
        this.burgerBtn.addEventListener("transitionend",this.bloomMenu);
        lastItem.addEventListener("transitionend",this.closeMenu);

        for (let i = 0; i < this.menuItems.length; i++) 
        {
            this.menuItems[i].style.transitionDuration = `${i+2}80ms`;
        }
    }

    toggleMenu()
    {
        if(!this.navigation || !this.menuItems)return;
        
        if(this.open)
        {
            this.witherMenu();
            return;
        }
        this.navigation.classList.add("open");
        this.open = true;
    }
    closeMenu()
    {
        if(!this.navigation || this.open)return;

        this.navigation.classList.remove("open");
    }
    bloomMenu(e:TransitionEvent)
    {
        if(!this.menuItems || e.propertyName != "translate" || !this.open || !this.burgerBtn)return;
        
        this.burgerBtn.style.scale = "0.8";

        let rot = 0;

        for (let i = 0; i < this.menuItems.length; i++) 
        {
            const li = this.menuItems[i];
            li.style.scale = "1";
            li.style.transform = `rotate(${rot-90}deg) translate(100px) rotate(${(rot-90)*-1}deg)`;
            rot += this.angle;
        }
    }
    witherMenu(e:PointerEvent|undefined = undefined)
    {
        if(!this.menuItems || e && e.target !== this.menu || !this.burgerBtn)return;

        this.open = false;

        this.burgerBtn.style.scale = "0.8";

        for (let i = 0; i < this.menuItems.length; i++) 
        {
            const li = this.menuItems[i];
            li.style.scale = "";
            li.style.transform = "";
        }
    }
}
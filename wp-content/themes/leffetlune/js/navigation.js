"use strict";
export class Navigation {
    openClass;
    transitionTrigger;
    navigation;
    burgerBtn = null;
    menu = null;
    menuItems = null;
    open = false;
    angle = 0;
    /**
     * Provoque l'ouverture et la fermeture d'un burger menu en fleur.
     * @param navSelector selecteur css de la nav englobante
     * @param menuSelector selecteur css du menu à déployer
     * @param menuItemSelector selecteur css des item à déployer
     * @param btnSelector selecteur css du bouton du menu
     * @param openClass classe provoquant l'ouverture
     * @param transitionTrigger transition qui doit provoquer l'ouverture du menu.
     */
    constructor(navSelector, menuSelector, menuItemSelector, btnSelector, openClass, transitionTrigger = "right") {
        this.openClass = openClass;
        this.transitionTrigger = transitionTrigger;
        this.navigation = document.querySelector(navSelector);
        if (!this.navigation) {
            console.error(`Élément de navigation "parent" introuvable`);
            return;
        }
        this.menu = this.navigation.querySelector(menuSelector);
        if (!this.menu) {
            console.error(`Élément de navigation "menu" introuvable`);
            return;
        }
        this.menuItems = this.menu.querySelectorAll(menuItemSelector);
        this.burgerBtn = this.navigation.querySelector(btnSelector);
        if (!this.menuItems.length || !this.burgerBtn) {
            console.error(`Élément de navigation "burger" ou "li" introuvable`);
            return;
        }
        this.angle = 360 / this.menuItems.length;
        this.setting();
    }
    /**
     * Paramètre les écouteurs dévènement et modifie le style de certains éléments.
     */
    setting() {
        if (!this.burgerBtn || !this.menu || !this.menuItems)
            return;
        this.toggleMenu = this.toggleMenu.bind(this);
        this.closeMenu = this.closeMenu.bind(this);
        this.bloomMenu = this.bloomMenu.bind(this);
        this.witherMenu = this.witherMenu.bind(this);
        const lastItem = this.menuItems[this.menuItems.length - 1];
        this.burgerBtn.addEventListener("pointerdown", this.toggleMenu);
        this.menu.addEventListener("pointerdown", this.witherMenu);
        this.burgerBtn.addEventListener("transitionend", this.bloomMenu);
        lastItem.addEventListener("transitionend", this.closeMenu);
        for (let i = 0; i < this.menuItems.length; i++) {
            this.menuItems[i].style.transitionDuration = `${i + 2}80ms`;
        }
    }
    /**
     * Ouvre ou ferme le menu
     */
    toggleMenu() {
        if (!this.navigation || !this.menuItems)
            return;
        if (this.open) {
            this.witherMenu();
            return;
        }
        this.navigation.classList.add(this.openClass);
        this.open = true;
    }
    /**
     * Ferme le menu
     */
    closeMenu() {
        if (!this.navigation || this.open)
            return;
        this.navigation.classList.remove(this.openClass);
    }
    /**
     * Ouvre la fleur.
     * @param e Transition Event
     */
    bloomMenu(e) {
        if (!this.menuItems || e.propertyName != this.transitionTrigger || !this.open || !this.burgerBtn)
            return;
        this.burgerBtn.style.scale = "0.8";
        let rot = 0;
        for (let i = 0; i < this.menuItems.length; i++) {
            const li = this.menuItems[i];
            li.style.scale = "1";
            li.style.transform = `rotate(${rot - 90}deg) translate(100px) rotate(${(rot - 90) * -1}deg)`;
            rot += this.angle;
        }
    }
    /**
     * Ferme la fleur.
     * @param e Pointer Event ou undefined
     */
    witherMenu(e = undefined) {
        if (!this.menuItems || e && e.target !== this.menu || !this.burgerBtn)
            return;
        this.open = false;
        this.burgerBtn.style.scale = "";
        for (let i = 0; i < this.menuItems.length; i++) {
            const li = this.menuItems[i];
            li.style.scale = "";
            li.style.transform = "";
        }
    }
}

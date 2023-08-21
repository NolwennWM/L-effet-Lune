"use strict";
export class Footer {
    openClass;
    footer;
    footerBtn = null;
    constructor(footerSelector, buttonSelector, openClass) {
        this.openClass = openClass;
        this.footer = document.querySelector(footerSelector);
        if (!this.footer) {
            console.error("Footer Introuvable");
            return;
        }
        this.footerBtn = this.footer.querySelector(buttonSelector);
        if (!this.footerBtn) {
            console.error("Bouton du Footer Introuvable");
            return;
        }
        this.setting();
    }
    setting() {
        if (!this.footerBtn)
            return;
        this.toggleFooter = this.toggleFooter.bind(this);
        this.footerBtn.addEventListener("pointerdown", this.toggleFooter);
    }
    toggleFooter() {
        if (!this.footer)
            return;
        this.footer.classList.toggle(this.openClass);
    }
}

"use strict";

export class Footer
{
    private footer: HTMLElement|null;
    private footerBtn: HTMLElement|null = null;

    constructor(footerSelector:string, buttonSelector:string, private openClass:string)
    {
        this.footer = document.querySelector(footerSelector);
        if(!this.footer)
        {
            console.error("Footer Introuvable");
            return;
        }
        this.footerBtn = this.footer.querySelector(buttonSelector);
        if(!this.footerBtn)
        {
            console.error("Bouton du Footer Introuvable");
            return;
        }
        this.setting();
    }
    setting()
    {
        if(!this.footerBtn)return;
        this.toggleFooter = this.toggleFooter.bind(this);
        this.footerBtn.addEventListener("pointerdown", this.toggleFooter);
    }
    toggleFooter()
    {
        if(!this.footer)return;
        this.footer.classList.toggle(this.openClass);
    }
}
"use strict";

export class Header
{
    private header: HTMLElement|null;
    private scrollElement: HTMLElement|null;

    private timestamp: number = 0;
    /**
     * Réduit ou augmente la taille du header selon le défilement de la page
     * @param headerSelector Selecteur CSS pour le header
     * @param scrollSelector Selecteur CSS pour l'élément scrollable
     * @param closeClass Classe CSS ayant pour rôle de fermer le header
     */
    constructor(headerSelector: string, scrollSelector: string, private closeClass:string)
    {
        this.header = document.querySelector(headerSelector);
        this.scrollElement = document.querySelector(scrollSelector)

        if(!this.header || !this.scrollElement)
        {
            console.error("Element(s) HTML non trouvé(s)");
            return;
        }
        this.setting();
    }
    /**
     * Met en place les écouteurs d'évènements du header.
     */
    setting()
    {
        if(!this.scrollElement || !this.header)return;
        this.toggleHeader = this.toggleHeader.bind(this);
        this.scrollElement.addEventListener("scroll", this.toggleHeader);
        this.header.addEventListener("pointerdown", this.toggleHeader);
        this.toggleHeader();
    }
    /**
     * Ajoute ou Retire la classe ayant pour rôle d'ouvrir ou fermer le header.
     */
    toggleHeader()
    {
        if(!this.scrollElement || !this.header)return;
        console.log(this.scrollElement.scrollTop === 0 && this.timestamp < Date.now()-500);
        
        if(this.scrollElement.scrollTop === 0 && this.timestamp < Date.now()-500)
            this.header.classList.remove(this.closeClass);
        else if(!this.header.classList.contains(this.closeClass))
        {
            this.header.classList.add(this.closeClass);
            this.timestamp = Date.now();
        }        
    }
}
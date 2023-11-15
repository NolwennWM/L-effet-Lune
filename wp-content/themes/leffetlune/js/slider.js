export class Slider {
    slider;
    timer;
    index = 0;
    interval = 0;
    images;
    btns;
    constructor(slider, timer = 3000) {
        this.slider = slider;
        this.timer = timer;
        this.images = slider.querySelectorAll(".items img");
        this.btns = this.slider.querySelectorAll(".btn-select");
        if (this.images.length == 0) {
            return;
        }
        this.addEvents();
        this.show();
        this.intervalSetting();
    }
    addEvents() {
        const btnLeft = this.slider.querySelector(".btn-left");
        const btnRight = this.slider.querySelector(".btn-right");
        if (btnLeft) {
            btnLeft.addEventListener("click", () => {
                this.prev();
                this.intervalSetting();
            });
        }
        if (btnRight) {
            btnRight.addEventListener("click", () => {
                this.next();
                this.intervalSetting();
            });
        }
        this.btns.forEach(btn => {
            btn.addEventListener('click', () => {
                const id = parseInt(btn.dataset.id ?? "");
                this.select(id);
                this.intervalSetting();
            });
        });
    }
    prev() {
        this.hide();
        this.index--;
        if (this.index < 0) {
            this.index = this.images.length - 1;
        }
        this.show();
    }
    next() {
        this.hide();
        this.index++;
        if (this.index > this.images.length - 1) {
            this.index = 0;
        }
        this.show();
    }
    select(id) {
        this.hide();
        this.index = id;
        this.show();
    }
    hide() {
        this.images[this.index].style.opacity = "0";
        this.btns[this.index].classList.remove("active");
    }
    show() {
        this.images[this.index].style.opacity = "1";
        this.btns[this.index].classList.add("active");
    }
    intervalSetting() {
        clearInterval(this.interval);
        this.interval = setInterval(() => {
            this.next();
        }, this.timer);
    }
}

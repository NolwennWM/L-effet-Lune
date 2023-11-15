<?php
wp_load_translations_early();

$protocol = wp_get_server_protocol();
header( "$protocol 503 Service Unavailable", true, 503 );
header( 'Content-Type: text/html; charset=utf-8' );
header( 'Retry-After: 30' );
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php _e( "L'effet Lune en Maintenance" ); ?></title>
    <style>
        body
        {
            background-image: linear-gradient(grey, gray);
            min-height: 100vh;
        }
        .content
        {
            backdrop-filter: blur(10px);
            position: absolute;
            top: 50%;
            left: 50%;
            translate: -50% -50%;
            border: 2px solid #ee82ee;
            border-radius: 10px;
            background-color: #90ee9040;
            padding: 0 16px;
            color: whitesmoke;
        }
    </style>
</head>
<body>
    <canvas id="background"></canvas>
    <div class="content">
        <h1><?php _e( "Maintenance de l'effet Lune" ); ?></h1>
        <p><?php _e( "C'est la nouvelle lune, encore un peu de patience pour que l'effet Lune vous atteigne." ); ?></p>
    </div>
<script>
    class Background {
        flashSize = { min: 2, max: 10 };
        flashColor1 = "rgba(255,255,255,0.8)";
        flashColor2 = "rgba(255,255,255,0.3)";
        flashMax = 10;
        flashMoveProbability = 0.001;
        flashGrow = 0.03;
        flashSpeed = 0.1;
        canvas;
        parent = null;
        ctx = null;
        flashList = [];
        /**
         * Créer des bulles se promenant à l'écran.
         * @param selector Selecteur CSS pour un canvas
         */
        constructor(selector) {
            this.canvas = document.querySelector(selector);
            if (!this.canvas) {
                console.error("Aucun Canvas Trouvé.");
                return this;
            }
            this.parent = this.canvas.parentElement || document.body;
            this.settings();
        }
        /**
         * Met en place les évènements et l'animation.
         * @returns {void}
         */
        settings() {
            if (!this.canvas)
                return;
            this.ctx = this.canvas.getContext("2d");
            this.resize = this.resize.bind(this);
            this.resize();
            window.addEventListener('resize', this.resize);
            this.animateFlash = this.animateFlash.bind(this);
            this.animateFlash();
        }
        /**
         * Change la taille du canvas.
         * @returns {void}
         */
        resize() {
            if (!this.canvas || !this.parent)
                return;
            const parentRect = this.parent.getBoundingClientRect();
            this.canvas.width = parentRect.width;
            this.canvas.height = parentRect.height;
        }
        /**
         * Lance l'animation qui se joue en boucle.
         * @returns {void}
         */
        animateFlash() {
            if (!this.ctx || !this.canvas)
                return;
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
            if (this.flashList.length < this.flashMax)
                this.createFlash();
            this.flashList = this.flashList.filter(this.drawFlash, this);
            requestAnimationFrame(this.animateFlash);
        }
        /**
         * Crée un objet "Flash" et le rentre dans la liste des flash en cours.
         * @returns {void}
         */
        createFlash() {
            const size = this.getRandomNumber(this.flashSize.min, this.flashSize.max);
            const mX = this.getRandomNumber(1, 2, true, 0.5) < 0;
            const mY = this.getRandomNumber(1, 2, true, 0.5) < 0;
            const pos = this.getRandomPos(size);
            if (!pos)
                return;
            this.flashList.push({ x: pos.x, y: pos.y, size: size, moveX: mX, moveY: mY, grow: true });
        }
        /**
         * Dessine l'objet Flash donné en argument.
         * Retourne true si l'objet doit toujours être visible sinon false.
         * @param flash Objet correspondant à une bulle
         * @returns {boolean}
         */
        drawFlash(flash) {
            if (!this.ctx)
                return false;
            const ctx = this.ctx;
            const grd = ctx.createRadialGradient(flash.x, flash.y, flash.size / 2, flash.x, flash.y, flash.size);
            grd.addColorStop(0, this.flashColor1);
            grd.addColorStop(0.7, this.flashColor2);
            ctx.fillStyle = grd;
            ctx.beginPath();
            ctx.arc(flash.x, flash.y, flash.size, 0, Math.PI * 2);
            ctx.fill();
            return this.moveFlash(flash);
        }
        /**
         * Déplace l'objet Flash donné en argument.
         * Puis vérifie si celui doit toujours être visible.
         * @param flash Objet correspondant à une bulle
         * @returns {boolean}
         */
        moveFlash(flash) {
            if (!this.canvas)
                return false;
            if (flash.grow && flash.size <= this.flashSize.max * 2)
                flash.size += this.flashGrow;
            else if (!flash.grow && flash.size >= this.flashSize.min / 2)
                flash.size -= this.flashGrow;
            else
                flash.grow = !flash.grow;
            if (this.getRandomNumber(1, 2, true) < 0)
                flash.moveX = !flash.moveX;
            if (this.getRandomNumber(1, 2, true) < 0)
                flash.moveY = !flash.moveY;
            if (flash.moveX)
                flash.x += this.flashSpeed;
            else
                flash.x -= this.flashSpeed;
            if (flash.moveY)
                flash.y += this.flashSpeed;
            else
                flash.y -= this.flashSpeed;
            if (flash.x < 0 - flash.size
                || flash.y < 0 - flash.size
                || flash.x > this.canvas.width + flash.size
                || flash.y > this.canvas.height + flash.size)
                return false;
            return true;
        }
        /**
         * retourne un nombre aléatoire.
         * @param min nombre aléatoire minimum
         * @param max nombre aléatoire maximum
         * @param negative boolean indiquant si il peut être negatif
         * @param probability probabilité d'avoir un nombre négatif
         * @returns {number}
         */
        getRandomNumber(min = 0, max = 100, negative = false, probability = this.flashMoveProbability) {
            if (negative) {
                let n = Math.random() < probability ? -1 : 1;
                return n * (Math.floor(Math.random() * (max - min)) + min);
            }
            return Math.floor(Math.random() * (max - min)) + min;
        }
        /**
         * Crée une position aléatoire de départ pour une bulle.
         * @param radius rayon de la bulle
         * @returns {Object|undefined}
         */
        getRandomPos(radius) {
            if (!this.canvas)
                return;
            return {
                x: this.getRandomNumber(radius, this.canvas.width),
                y: this.getRandomNumber(radius, this.canvas.height)
            };
        }
    }
    new Background("canvas#background");
</script>
</body>
</html>
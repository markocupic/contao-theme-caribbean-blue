document.addEventListener("DOMContentLoaded", function () {
    let self = {};

    function init() {
        const karteLayer = document.getElementById("leitbild_karte");
        if (!karteLayer) return;

        const leitbildTextElements = document.querySelectorAll(".leitbild_text");
        leitbildTextElements.forEach(function (el) {
            karteLayer.appendChild(el);
        });

        const titelLayer = document.getElementById("leitbild_titel_layer");
        karteLayer.appendChild(titelLayer);

        startFader();
        self.activeElement = "leitbild_text_0";

        // Events
        document.getElementById("leitbild_text_0").addEventListener("click", function (event) {
            event.stopPropagation();
            fadeInElement("leitbild_titel_layer");
            toggleMapSource(2);
            fade_In("leitbild_text_1", 1);
        });

        const titelElements = ["leitbild_titel_1", "leitbild_titel_2", "leitbild_titel_3", "leitbild_titel_4"];
        titelElements.forEach(function (id, index) {
            const elem = document.getElementById(id);
            if (elem) {
                elem.addEventListener("click", function (event) {
                    event.stopPropagation();
                    toggleMapSource(2);
                    fade_In("leitbild_text_" + (index + 1), index + 1);
                });
            }
        });

        // Initialized fade in the links now
        titelLayer.classList.remove('invisible');
    }

    function fade_In(elementId, index) {
        if (self.index === index) return;
        self.activeElement = elementId;
        self.index = index;

        document.querySelectorAll(".leitbild_text").forEach(function (el) {
            if (el.id !== self.activeElement) {
                el.style.display = "none";
                el.style.opacity = "0";
            } else {
                el.style.display = "block";
                el.style.opacity = "1";
                fadeInElement(el);
            }
        });
    }

    function fadeInElement(elementId) {
        const el = document.getElementById(elementId);
        if (el) {
            el.style.display = "block";
            el.style.opacity = "0";
            let opacity = 0;
            const interval = setInterval(function () {
                opacity += 0.05;
                el.style.opacity = opacity;
                if (opacity >= 1) clearInterval(interval);
            }, 50);
        }
    }

    function startFader() {
        const karteLayer = document.getElementById("leitbild_karte");
        let fontSize = Math.floor(karteLayer.offsetHeight / 30);
        fontSize = Math.min(fontSize, 18) + "px";

        document.querySelectorAll("#leitbild_titel_layer h4").forEach(function (el) {
            el.style.fontSize = fontSize;
        });

        fadeInElement("leitbild_titel_layer");
        fadeInElement("leitbild_text_0");

        self.index = 0;
    }

    function toggleMapSource(type) {
        const wrapper = document.getElementById("mod_leitbild");
        const mediaPath = wrapper.dataset.mediapath;
        const img = document.querySelector("#leitbild_karte img");
        if (img) {
            img.src = mediaPath + "/karte_innenseite_mit_logo_" + type + ".jpg";
        }
    }

    init();
});

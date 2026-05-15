class ThemeSwitch {
    setTheme = (theme) => {
        const elHtml = document.querySelector('html');
        elHtml.setAttribute("data-bs-theme", theme);
        localStorage.setItem("theme", theme);

        if (theme === "dark") {
            this.updateSwitches(theme);
        }
    }

    getTheme = function () {
        return localStorage.getItem("theme") || "light";
    }

    toggleTheme = () => {
        let newTheme = this.getTheme() === "dark" ? "light" : "dark";
        this.setTheme(newTheme);
    }

    updateSwitches = (theme) => {
        const switches = document.querySelectorAll('[data-bs-theme-switch]');
        for (const elSwitch of switches) {
            elSwitch.checked = theme === "dark";
        }
    }
}


// Apply saved theme on page load
document.addEventListener("DOMContentLoaded", () => {
    const themeSwitch = new ThemeSwitch();
    themeSwitch.setTheme(themeSwitch.getTheme());
});

document.addEventListener("DOMContentLoaded", () => {
    const switches = document.querySelectorAll('[data-bs-theme-switch]');
    for (const elSwitch of switches) {
        elSwitch.addEventListener("change", () => {
            const themeSwitch = new ThemeSwitch();

            if (elSwitch.checked) {
                themeSwitch.setTheme('dark');
            } else {
                themeSwitch.setTheme('light');
            }
        });
    }
});

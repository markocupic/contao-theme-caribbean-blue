/**
 * Header dropdown navigation script for Contao CMS (pure vanilla script)
 * @author Marko Cupic, Oberkirch 2023
 */
window.addEventListener('DOMContentLoaded', () => {

    const hideSubmenus = () => {
        const expanded = document.querySelectorAll('#header .mod_navigation .expanded');

        if (expanded) {
            for (const elExpandedListItem of expanded) {
                elExpandedListItem.classList.remove('expanded');
            }
        }
    }

    // Close all submenus, before open a new one
    const links = document.querySelectorAll('#header .mod_navigation ul.level_1 > li > a, #header .mod_navigation ul.level_1 > li>a:after, #header .mod_navigation ul.level_1 > li > strong');

    if (links) {
        for (const linkClicked of links) {

            linkClicked.addEventListener('click', (eventClick) => {
                if (!eventClick.target.closest('li').classList.contains('submenu')) {
                    return true;
                } else {
                    eventClick.stopPropagation();
                    eventClick.preventDefault();

                    // Get all expanded nav items
                    const expanded = eventClick.target.closest('ul').querySelectorAll('.expanded');

                    const promise = new Promise(resolve => {
                        for (const elExpandedListItem of expanded) {
                            // Remove the CSS "expanded" class
                            elExpandedListItem.classList.remove('expanded');
                        }
                        resolve('done');
                    });

                    promise.then(valueResolve => {
                        // Add the CSS "expanded" class
                        eventClick.target.closest('li').classList.add('expanded');
                    });

                    return false;
                }

            });
        }
    }

    // Hide submenus on window resize
    window.addEventListener('resize', function (e) {
        e.preventDefault();
        hideSubmenus();
    });

    // Hide submenus on scroll
    window.addEventListener('scroll', function (e) {
        e.preventDefault();
        hideSubmenus();
    });

    // Hide submenus, when clicking outside
    document.addEventListener('click', function (e) {
        // child
        const clickedEl = e.target;

        // parent
        const navigation = document.querySelector('#header .mod_navigation .level_1');

        // Use this helper function, to check if an element is a child of a given parent element
        const contains = (parent, child) => {
            return parent !== child && parent.contains(child);
        }

        if (!Object.is(clickedEl, navigation) && !contains(navigation, clickedEl)) {
            hideSubmenus();
        }
    });
});
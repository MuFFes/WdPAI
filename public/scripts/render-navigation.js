(() => {
    const navigationContainer = document.querySelector(".navigation");
    let controllerMapping = window.location.pathname.split("/")[1];

    const colors = [
        "var(--color-wisteria)",
        "var(--color-belizehole)",
        "var(--color-carrot)",
        "var(--color-nephritis)",
        "var(--color-pomegranate)",
        "var(--color-amethyst)",
        "var(--color-peterriver)",
        "var(--color-greensea)",
        "var(--color-orange)",
        "var(--color-turquoise)",
    ]

    fetch(`http://localhost:8080/${controllerMapping}/getnavigation`, {
        method: "GET",
        body: JSON.stringify()
    })
        .then(response => response.json())
        .then(response => {
            console.log(response)
            for (const [index, [name, src, icon]] of response.entries()){
                let iconElement = document.createElement('i');
                iconElement.className = `fas ${icon}`;

                let textElement = document.createElement('span');
                textElement.textContent = name;

                let element     = document.createElement('a');
                element.className        = "navigation__button";
                element.style.background = colors[index % colors.length];
                element.setAttribute("href", src);

                navigationContainer.appendChild(element);
                element.appendChild(iconElement);
                element.appendChild(textElement);
            }
        })
})();

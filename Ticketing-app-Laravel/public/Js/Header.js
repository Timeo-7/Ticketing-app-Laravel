const DROP_BUTTON = document.querySelector(".Drop-button");

window.addEventListener("DOMContentLoaded", function () {
    const DROP_CONTENT = document.querySelector(".Drop-content");

    if (!DROP_CONTENT.classList.contains("titanic")) {
        DROP_CONTENT.classList.add("titanic");
    }
    
});

DROP_BUTTON.addEventListener("click", function(){

    const DROP_CONTENT = document.querySelector(".Drop-content");

    DROP_CONTENT.classList.toggle("titanic");

});


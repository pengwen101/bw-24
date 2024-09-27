let choiceBoxes = Array.from(document.getElementsByClassName("choice-box"));

choiceBoxes.forEach((choiceBox) => {
    choiceBox.addEventListener("click", () => {
        let name = choiceBox.getAttribute("name");

        // Find all choiceBoxs with the same name and remove the "selected" and "bg-red-500" classes
        choiceBoxes.forEach((otherchoiceBox) => {
            if (otherchoiceBox.getAttribute("name") === name) {
                otherchoiceBox.classList.remove("selected", "bg-red-500");
            }
        });

        // Add "selected" and "bg-red-500" classes to the clicked choiceBox
        choiceBox.classList.add("selected", "bg-red-500");

        choiceBox.closest(".quiz-container").nextElementSibling.classList.remove("hidden");
        setTimeout(()=>{
            choiceBox.closest(".quiz-container").classList.add("hidden");
            choiceBox.closest(".quiz-container").querySelector(".next-question").classList.remove("hidden");

        }, 500)
    });
});

let firstContainer = document.getElementById("Q1");
firstContainer.classList.remove("hidden");

firstContainer.querySelector(".prev-question").classList.add("hidden");

let nextQuestions = Array.from(document.getElementsByClassName("next-question"));
nextQuestions.forEach((nextQuestion)=>{
    nextQuestion.addEventListener("click", ()=>{
        let container = nextQuestion.closest(".question-container");
        let nextContainer = container.nextElementSibling;
        container.classList.add("hidden");
        nextContainer.classList.remove("hidden");
    });
});

let prevQuestions = Array.from(document.getElementsByClassName("prev-question"));
prevQuestions.forEach((prevQuestion)=>{
    prevQuestion.addEventListener("click", ()=>{
        let container = prevQuestion.closest(".question-container");
        let prevContainer = container.previousElementSibling;
        container.classList.add("hidden");
        prevContainer.classList.remove("hidden");
    });
});
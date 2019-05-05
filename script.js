;document.addEventListener("DOMContentLoaded", function()
{
    const FORM_ID = "sf";
    const ANSWER_ID = "answer";
    const SEND_TO_URL = "function.php";
    const PRELOADER = document.createElement("div");
    PRELOADER.classList.add("preloader");
    PRELOADER.hidden = true;
    document.body.appendChild(PRELOADER);

    const searchForm = document.getElementById(FORM_ID);
    searchForm.addEventListener("submit", event => event.preventDefault());
    searchForm.addEventListener("submit", (event) => 
    {
        PRELOADER.hidden = false;
        answerField.hidden = true;
        sendForm(searchForm, SEND_TO_URL, (now, total) =>
        {
            console.log(now, total, total - now);
        })
        .then((response) =>
        {
            answerField.innerHTML = response;
            PRELOADER.hidden = true;
            answerField.hidden = false;
        })
        .catch(console.error);
    });

    const answerField = document.getElementById(ANSWER_ID);
    answerField.innerHTML = null;

    
    function sendForm(form, url, progress)
    {
        return new Promise((resolve, reject) => 
        {
            const xhr = new XMLHttpRequest();
            xhr.addEventListener("readystatechange", function()
            {
                switch(xhr.readyState)
                {
                    case XMLHttpRequest.OPENED:
                        xhr.send(new FormData(form));
                        break;
                    case XMLHttpRequest.DONE:
                        resolve(xhr.response);
                        break;
                }
            });
            if (progress)
            {
                xhr.upload.addEventListener("progress", (event) =>
                {
                    progress(event.loaded, event.total);
                });
            }
            xhr.addEventListener("error", reject);
            xhr.open("POST", url);
        });
    }
});
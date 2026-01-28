function sendMessage() {
    let input = document.getElementById("user-input");
    let chatBox = document.getElementById("chat-box");
    let message = input.value.trim();

    if (message === "") return;

    chatBox.innerHTML += `<div class="user"><b>You:</b> ${message}</div>`;
    input.value = "";

    fetch("chatbot.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "message=" + encodeURIComponent(message)
    })
    .then(res => res.text())
    .then(reply => {
        chatBox.innerHTML += `<div class="bot"><b>Bot:</b> ${reply}</div>`;
        chatBox.scrollTop = chatBox.scrollHeight;
    })
    .catch(() => {
        chatBox.innerHTML += `<div class="bot">Error connecting to AI</div>`;
    });
    
    
}

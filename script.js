function saveTodo() {
    const task = document.getElementById("task").value;

    fetch("insert.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            task: task,
            finished: 0
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
    });
}
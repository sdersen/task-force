const taskContainers = document.querySelectorAll('.task-container');

taskContainers.forEach((taskContainer) => {
    const editTaskBtn = taskContainer.querySelector('.edit-task-btn');
    const taskEditField = taskContainer.querySelector('.edit-container');
    const taskDoneBtn = taskContainer.querySelector('.done-task-btn');

    editTaskBtn.addEventListener('click', () => {
        taskEditField.classList.toggle('hidden');
    });
    // Funkar inte eftersom sidan hoppar till done.php och sen tillbaka
    taskDoneBtn.addEventListener('click', () => {
        taskContainer.classList.add('task-done');
    });
});

// const updateProfileField = document.querySelector('.update-profile-container');
// const updateProfileBtn = document.querySelector('.update-profile-btn');

// taskEditFields.forEach((taskEditField) => {});

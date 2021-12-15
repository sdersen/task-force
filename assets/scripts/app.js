const taskContainers = document.querySelectorAll('.task-container');

taskContainers.forEach((taskContainer) => {
    console.log('container skapad');
    const editTaskBtn = taskContainer.querySelector('.edit_task_btn');
    const taskEditField = taskContainer.querySelector('.edit-container');

    editTaskBtn.addEventListener('click', () => {
        taskEditField.classList.toggle('hidden');
        console.log('klick');
    });
});

// const updateProfileField = document.querySelector('.update-profile-container');
// const updateProfileBtn = document.querySelector('.update-profile-btn');

// taskEditFields.forEach((taskEditField) => {});

const openCreateTaskBtn = document.querySelector('.open-create-task-btn');
const createTaskContainer = document.querySelector('.create-task-container');
openCreateTaskBtn.addEventListener('click', () => {
    createTaskContainer.classList.toggle('hidden');
});

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

const listContainers = document.querySelectorAll('.list-container');

listContainers.forEach((listContainer) => {
    const editListBtn = listContainer.querySelector('.edit-list-btn');
    const listEditContainer = listContainer.querySelector(
        '.edit-list-container'
    );
    // const taskDoneBtn = listContainer.querySelector('.done-task-btn');
    console.log('hej');

    editListBtn.addEventListener('click', () => {
        listEditContainer.classList.toggle('hidden');
    });
});

// Toggle update profile on profile.php ********************
const updateProfileBtn = document.querySelector('.update-profile-btn');
const updateProfileContainer = document.querySelector(
    '.update-profile-container'
);

updateProfileBtn.addEventListener('click', () => {
    updateProfileContainer.classList.toggle('hidden');
});



// Toggle create task on index.php ********************
const openCreateTaskBtn = document.querySelector('.open-create-task-btn');
const createTaskContainer = document.querySelector('.create-task-container');
openCreateTaskBtn.addEventListener('click', () => {
    createTaskContainer.classList.toggle('hidden');
});

// Toggles edit task field on index.php ********************
const taskContainers = document.querySelectorAll('.task-container');

taskContainers.forEach((taskContainer) => {
    const editTaskBtn = taskContainer.querySelector('.edit-task-btn');
    const addListForm = taskContainer.querySelector('.list-form');
    const addListBtn = taskContainer.querySelector('.add-list-btn');
    const taskEditField = taskContainer.querySelector('.edit-container');

    editTaskBtn.addEventListener('click', () => {
        taskEditField.classList.toggle('hidden');
    });

    addListBtn.addEventListener('click', () => {
        addListForm.classList.toggle('hidden');
        console.log('add list');
    });
});

// Toggles edit list field on lists.php ********************
const listContainers = document.querySelectorAll('.list-container');

listContainers.forEach((listContainer) => {
    const editListBtn = listContainer.querySelector('.edit-list-btn');
    const listEditContainer = listContainer.querySelector(
        '.edit-list-container'
    );
    console.log('hej');

    editListBtn.addEventListener('click', () => {
        listEditContainer.classList.toggle('hidden');
        console.log('du har klickat');
    });
});

// Toggle update profile on profile.php ********************
// const updateProfileBtn = document.querySelector('.update-profile-btn');
// const updateProfileContainer = document.querySelector(
//     '.update-profile-container'
// );

// updateProfileBtn.addEventListener('click', () => {
//     updateProfileContainer.classList.toggle('hidden');
//     console.log('hej');
// });

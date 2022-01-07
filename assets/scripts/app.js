// Toggle create task on index.php ********************
const createTaskContainer = document.querySelector('.create-task-container');
if (createTaskContainer) {
    const openCreateTaskBtn = document.querySelector('.open-create-task-btn');
    openCreateTaskBtn.addEventListener('click', () => {
        createTaskContainer.classList.toggle('hidden');
    });
}
// Toggle create list on lists.php ********************
const createListContainer = document.querySelector('.create-list-container');
if (createListContainer) {
    const openCreateListBtn = document.querySelector('.open-create-list-btn');
    openCreateListBtn.addEventListener('click', () => {
        console.log('öppna lista');
        createListContainer.classList.toggle('hidden');
    });
}

// Toggles edit task field on index.php ********************
const taskContainers = document.querySelectorAll('.task-container');

if (taskContainers) {
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

        // Tillhör test ------------------------------------------------------

        const form = taskContainer.querySelector('.done-form');
        const doneInput = taskContainer.querySelector('input[type=checkbox]');

        // When the user clicks on the checkbox the form will automagically submit.
        doneInput.addEventListener('click', () => form.submit());
    });
}

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

// Submits form on a task in a list
const tasksInLists = document.querySelectorAll('.task-container-in-list');
tasksInLists.forEach((taskInlist) => {
    const form = taskInlist.querySelector('.done-form-list');
    const doneInput = taskInlist.querySelector('input[type=checkbox]');

    doneInput.addEventListener('click', () => form.submit());
});

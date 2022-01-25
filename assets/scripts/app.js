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
    const checklistBtn = taskContainer.querySelector('.show-checklist-btn');
    const checklistForm = taskContainer.querySelector('.checklist-form');

    editTaskBtn.addEventListener('click', () => {
      taskEditField.classList.toggle('hidden');
    });

    addListBtn.addEventListener('click', () => {
      addListForm.classList.toggle('hidden');
    });

    checklistBtn.addEventListener('click', () => {
      checklistForm.classList.toggle('hidden');
    });

    // Submits form for a task ---------------------------------------------

    const form = taskContainer.querySelector('.done-form');
    const doneInput = taskContainer.querySelector('input[type=checkbox]');

    doneInput.addEventListener('click', () => form.submit());
  });
}

// Toggles edit list field on lists.php ********************
const listContainers = document.querySelectorAll('.list-container');

listContainers.forEach((listContainer) => {
  const editListBtn = listContainer.querySelector('.edit-list-btn');
  const listEditContainer = listContainer.querySelector('.edit-list-container');

  editListBtn.addEventListener('click', () => {
    listEditContainer.classList.toggle('hidden');
  });
});

// Submits form on a task in a list.
const tasksInLists = document.querySelectorAll('.task-container-in-list');
tasksInLists.forEach((taskInlist) => {
  const form = taskInlist.querySelector('.done-form-list');
  const doneInput = taskInlist.querySelector('input[type=checkbox]');

  doneInput.addEventListener('click', () => form.submit());
});

// NEW FUNCTION FOR CHECKLIST ITEMS AND CHECKBOXES
const checklistItems = document.querySelectorAll('.checklist-items');
checklistItems.forEach((checklistItem) => {
  const checkbox = checklistItem.querySelector('input[type=checkbox]');
  checkbox.addEventListener('change', () => {
    const formData = new FormData(checklistItem);
    for (var [key, value] of formData.entries()) {
      console.log(key, value);
    }
    fetch('/app/tasks/done.php', {
      method: 'post',
      body: new FormData(checklistItem),
    }).then((response) => {
      if (checklistItem.classlist === 'subtask-complete') {
        checklistItem.classList.remove('subtask-complete');
      }
      checklistItem.classList.toggle('subtask-complete');
    });
  });
});

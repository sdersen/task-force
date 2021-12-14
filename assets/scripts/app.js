const taskEditField = document.querySelector('.edit-container');
const editTaskBtns = document.querySelectorAll('.edit_task_btn');

// Funkar ej
editTaskBtns.forEach((editTaskBtn) => {
  editTaskBtn.addEventListener('click', () => {
    taskEditField.classList.toggle('hidden');
    console.log('hej');
  });
});

const updateProfileField = document.querySelector('.update-profile-container');
const updateProfileBtn = document.querySelector('.update-profile-btn');

// taskEditFields.forEach((taskEditField) => {});

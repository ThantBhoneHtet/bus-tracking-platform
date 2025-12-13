const btnDelete_t1 = document.querySelectorAll('.delete-btn-t1');
const btnDelete_t2 = document.querySelectorAll('.delete-btn-t2');
const btnDelete_t3 = document.querySelectorAll('.delete-btn-t3'); // Added for -t3
const btnClose_t1 = document.querySelector('.cancel-btn-t1');
const btnClose_t2 = document.querySelector('.cancel-btn-t2');
const btnClose_t3 = document.querySelector('.cancel-btn-t3'); // Added for -t3
const deleteBox_t1 = document.querySelector('.delete-container-t1');
const deleteBox_t2 = document.querySelector('.delete-container-t2');
const deleteBox_t3 = document.querySelector('.delete-container-t3'); // Added for -t3
const rowt1 = document.querySelectorAll('#row-t1');
const rowt2 = document.querySelectorAll('#row-t2');
const rowt3 = document.querySelectorAll('#row-t3'); // Added for -t3
const confirm_btn_t1 = document.querySelector('.confirm-btn-t1');
const confirm_btn_t2 = document.querySelector('.confirm-btn-t2');
const confirm_btn_t3 = document.querySelector('.confirm-btn-t3'); // Added for -t3

const adminProfileBox = document.querySelector('.admin__profile-box');
const adminProfile = document.querySelector('.admin__profile');
const adminProfileCloseBtn = document.querySelector(
  '.admin__profile-close-btn'
);

adminProfile.addEventListener('click', () => {
  adminProfileBox.classList.add('admin__profile-box-show');
});

adminProfileCloseBtn.addEventListener('click', () => {
  adminProfileBox.classList.toggle('admin__profile-box-show');
});

for (let i = 0; i < btnDelete_t1.length; i++) {
  btnDelete_t1[i].addEventListener('click', () => {
    deleteBox_t1.classList.add('delete-box-show');

    confirm_btn_t1.addEventListener('click', (e) => {
        e.preventDefault();
        let id = rowt1[i].getAttribute("data-row");
        window.location.href = `../AdminController/deleteRow.php?BusLineid=${id}`;
        deleteBox_t1.classList.remove('delete-box-show');
    })
  });
}

for (let i = 0; i < btnDelete_t2.length; i++) {
  btnDelete_t2[i].addEventListener('click', () => {
    deleteBox_t2.classList.add('delete-box-show');

    confirm_btn_t2.addEventListener('click', () => {
        let id= rowt2[i].getAttribute("data-id");
        window.location.href = `../AdminController/deleteRow.php?BusStopid=${id}`;
        deleteBox_t2.classList.remove('delete-box-show');
    })
  });
}

// Added functionality for -t3
for (let i = 0; i < btnDelete_t3.length; i++) {
  btnDelete_t3[i].addEventListener('click', () => {
    deleteBox_t3.classList.add('delete-box-show');
    console.log(rowt3[i].getAttribute("data-id"))
    confirm_btn_t3.addEventListener('click', () => {
        let id = rowt3[i].getAttribute("data-id");
        window.location.href = `../AdminController/deleteRow.php?Userid=${id}`;
        deleteBox_t3.classList.remove('delete-box-show');
    })
  });
}

if (btnClose_t1 ){
  btnClose_t1.addEventListener('click', () => {
    deleteBox_t1.classList.remove('delete-box-show');
  });
}

if (btnClose_t2) {
  btnClose_t2.addEventListener('click', () => {
    deleteBox_t2.classList.remove('delete-box-show');
  });
}

// Added close functionality for -t3
if (btnClose_t3) {
  btnClose_t3.addEventListener('click', () => {
    deleteBox_t3.classList.remove('delete-box-show');
  });
}

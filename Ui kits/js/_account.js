const UserProfile = document.querySelector('.user__profile');
const UserProfileBox = document.querySelector('.user__profile-box');
const userProfileCloseBtn = document.querySelector('.user__profile-close-btn');

if (UserProfile) {
  UserProfile.addEventListener('click', () => {
    UserProfileBox.classList.add('user__profile-box-show');
  });
  
}

userProfileCloseBtn.addEventListener('click', () => {
  UserProfileBox.classList.toggle('user__profile-box-show');
});


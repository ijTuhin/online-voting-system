
// Theme Toggler for Dark Mode & Light Mode ,,, Hide & See Password Using Eye Icon

let themeToggler = document.querySelector('#theme-toggler');
let togglePassword = document.querySelector('#togglePassword');
let password = document.querySelector('#id_password');

themeToggler.onclick = () => {
    themeToggler.classList.toggle('fa-sun');
    

    if (themeToggler.classList.contains('fa-sun')) {
        document.body.classList.add('active');
        localStorage.setItem('active',themeToggler.classList.contains('fa-sun'));
        localStorage.setItem('fa-sun');
    } else {
        document.body.classList.remove('active');
        localStorage.removeItem('active',themeToggler.classList.contains('fa-sun'));
        localStorage.setItem('fa-moon-o');
    }

}

togglePassword.onclick = () => {
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);
  togglePassword.classList.toggle('fa-eye-slash');
};
document.addEventListener('DOMContentLoaded', (ev) =>{
    const roleSelect = document.getElementById('role');

    const customers = document.querySelectorAll('.customer-block');

    roleSelect.addEventListener('change', (ev) =>{
        if(roleSelect.value === 'customer' ){

            customers.forEach(customer => {
                customer.classList.add('block');
                customer.classList.remove('hidden');
            });

        }else{
            customers.forEach(customer => {
                customer.classList.add('hidden');
                customer.classList.remove('block');
            })
        }
    })
})

const password = document.getElementById('password');
const confirm_password = document.getElementById('confirm-password');

function validatePassword() {
    if (password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords do not match");
    } else {
        confirm_password.setCustomValidity('');
    }
}

password.addEventListener('change', validatePassword);
confirm_password.addEventListener('keyup', validatePassword);
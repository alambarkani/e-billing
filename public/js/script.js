document.addEventListener('DOMContentLoaded', (ev) =>{
    const roleSelect = document.getElementById('role');

    const customers = document.querySelectorAll('.customer-block');
    const admins = document.querySelectorAll('.admin-block');
    const pass = document.querySelectorAll('.pass-block');

    roleSelect.addEventListener('change', (ev) =>{
        if(roleSelect.value === 'customer' ){

            pass.forEach(p => {
                p.classList.add('block');
                p.classList.remove('hidden');
            })

            customers.forEach(customer => {
                customer.classList.add('block');
                customer.classList.remove('hidden');
            });

            admins.forEach(admin => {
                admin.classList.add('hidden');
                admin.classList.remove('block');
            });

        }else{

            pass.forEach(p => {
                p.classList.add('block');
                p.classList.remove('hidden');
            })

            customers.forEach(customer => {
                customer.classList.add('hidden');
                customer.classList.remove('block');
            })

            admins.forEach(admin => {
                admin.classList.add('block');
                admin.classList.remove('hidden');
            });

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

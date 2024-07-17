document.addEventListener('DOMContentLoaded', () => {
    const lists = [
        { name: 'イチゴ', img: 'strawberry.jpg', price: 450, ingredients: ['いちご', '砂糖', '水'] },
        { name: 'ライム', img: 'lime.jpg', price: 400, ingredients: ['ライム', '砂糖', '水'] },
        { name: 'マンゴー', img: 'mango.jpg', price: 500, ingredients: ['マンゴー', '砂糖', '水'] },
        { name: 'レモン', img: 'lemon.jpg', price: 400, ingredients: ['レモン', '砂糖', '水'] },
        { name: 'イチジク', img: 'fig.jpg', price: 500, ingredients: ['いちじく', '砂糖', '水'] },
        { name: 'リンゴ', img: 'apple.jpg', price: 400, ingredients: ['りんご', '砂糖', '水'] },
        { name: 'コーラ', img: 'cola.jpg', price: 250, ingredients: ['炭酸水', '砂糖', 'カラメル色素'] }
    ];

    const menu = document.querySelector('#menu');
    const orderList = document.querySelector('#orderList');
    const totalPrice = document.querySelector('#totalPrice');
    const personalInfo = document.querySelector('#personalInfo');
    const ingredientModal = document.querySelector('#ingredientModal');
    const ingredientTitle = document.querySelector('#ingredientTitle');
    const ingredientList = document.querySelector('#ingredientList');
    let cart = [];

    function showMenuItems() {
        lists.forEach((item, index) => {
            const content = `
                <div class="menu-item">
                    <img src="images/${item.img}" alt="${item.name}" onclick="showIngredients(${index})">
                    <h2>${item.name}</h2>
                    <p>${item.price}円</p>
                    <button onclick="addToCart(${index})">注文する</button>
                </div>`;
            menu.insertAdjacentHTML('beforeend', content);
        });
    }

    window.addToCart = function(index) {
        const selectedItem = lists[index];
        cart.push(selectedItem);
        showOrderSummary();
    }

    window.removeFromCart = function(index) {
        cart.splice(index, 1);
        showOrderSummary();
    }

    window.showIngredients = function(index) {
        const selectedItem = lists[index];
        ingredientTitle.textContent = selectedItem.name;
        ingredientList.textContent = `材料: ${selectedItem.ingredients.join(', ')}`;
        ingredientModal.classList.remove('hidden');
    }

    function showOrderSummary() {
        orderList.innerHTML = '';

        let total = 0;
        cart.forEach((item, index) => {
            const li = document.createElement('li');
            li.className = 'order-item';

            const itemText = document.createElement('span');
            itemText.textContent = `${item.name} - ${item.price}円`;

            const cancelButton = document.createElement('button');
            cancelButton.textContent = '取り消す';
            cancelButton.addEventListener('click', () => {
                removeFromCart(index);
            });

            li.appendChild(itemText);
            li.appendChild(cancelButton);
            orderList.appendChild(li);
            total += item.price;
        });

        totalPrice.textContent = `合計金額: ${total}円`;
    }

    document.querySelector('#proceedToPersonalInfo').addEventListener('click', () => {
        document.querySelector('#orderSummary').classList.add('hidden');
        personalInfo.classList.remove('hidden');
    });

    document.querySelector('#personal-info-form').addEventListener('submit', (event) => {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;

        const orderData = {
            items: cart,
            total: cart.reduce((sum, item) => sum + item.price, 0),
            customer: { name, email }
        };

        fetch('submit_order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                localStorage.setItem('orderData', JSON.stringify(orderData));
                window.location.href = 'order_confirmation.html';
            } else {
                alert(data.message);
            }
        });
    });

    document.querySelector('.close-button').addEventListener('click', () => {
        ingredientModal.classList.add('hidden');
    });

    showMenuItems();
});

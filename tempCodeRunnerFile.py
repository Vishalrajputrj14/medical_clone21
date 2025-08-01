from flask import Flask, render_template, session, redirect, url_for, request

app = Flask(__name__)
app.secret_key = 'your_secret_key'

# Sample products (In real app, use MySQL)
products = {
    1: {"name": "Paracetamol 500mg", "price": 30},
    2: {"name": "Cough Syrup", "price": 85},
    3: {"name": "Vitamin C Tablets", "price": 120},
    4: {"name": "Diabetes Kit", "price": 499},
    5: {"name": "Disprin Tablets", "price": 15},
    6: {"name": "Hand Sanitizer", "price": 55},
}

@app.route('/')
def home():
    return render_template('index.html')

@app.route('/medicines')
def medicines():
    return render_template('medicines.html', products=products)

@app.route('/add_to_cart/<int:product_id>')
def add_to_cart(product_id):
    cart = session.get('cart', {})
    cart[product_id] = cart.get(product_id, 0) + 1
    session['cart'] = cart
    return redirect(url_for('cart'))

@app.route('/cart')
def cart():
    cart = session.get('cart', {})
    cart_items = []
    total = 0
    for pid, qty in cart.items():
        item = products.get(pid)
        if item:
            item_total = item['price'] * qty
            total += item_total
            cart_items.append({
                'id': pid,
                'name': item['name'],
                'price': item['price'],
                'qty': qty,
                'total': item_total
            })
    return render_template('cart.html', cart_items=cart_items, total=total)

@app.route('/remove/<int:product_id>')
def remove(product_id):
    cart = session.get('cart', {})
    if product_id in cart:
        del cart[product_id]
    session['cart'] = cart
    return redirect(url_for('cart'))

if __name__ == '__main__':
    app.run(debug=True)

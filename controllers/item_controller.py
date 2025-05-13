from flask import Blueprint, jsonify, request
from services.item_service import ItemService

item_bp = Blueprint('item_bp', __name__)
item_service = ItemService()

@item_bp.route('/', methods=['GET'])
def get_items():
    items = item_service.get_all_items()
    data = [{
        "id": item.id,
        "name": item.name,
        "status": item.get_rental_details()
    } for item in items]
    return jsonify(data), 200

@item_bp.route('/rent', methods=['POST'])
def rent_item():
    data = request.json
    try:
        item = item_service.rent_item(data['id'], data['startDate'], data['endDate'])
        return jsonify({
            "message": f"Item rented successfully from {data['startDate']} to {data['endDate']}"
        }), 200
    except Exception as e:
        return jsonify({"error": str(e)}), 400

@item_bp.route('/<int:item_id>', methods=['GET'])
def get_item_details(item_id):
    try:
        item = item_service.get_item_by_id(item_id)
        return jsonify({
            "id": item.id,
            "name": item.name,
            "status": item.get_rental_details()
        }), 200
    except Exception as e:
        return jsonify({"error": str(e)}), 404

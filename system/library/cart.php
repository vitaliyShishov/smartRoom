<?php
/**
 * Класс для работы с корзиной
 *
 * PHP version 5.3
 *
 */
class Cart {

    /**
     * Объект $config
     * @var
     */
	private $config;

    /**
     * Объект $db
     *
     * @var
     */
	private $db;

    /**
     * Массив содержимого корзины
     * @var array
     */
	private $data = array();

    /**
     * Конструктор класса
     *
     * @param $registry
     */
	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->customer = $registry->get('customer');
		$this->session = $registry->get('session');
		$this->db = $registry->get('db');
		$this->tax = $registry->get('tax');

		if (!isset($this->session->data['cart']) || !is_array($this->session->data['cart'])) {
			$this->session->data['cart'] = array();
		}

		if (!isset($this->session->data['cart_size']) || !is_array($this->session->data['cart_size'])) {
			$this->session->data['cart_size'] = array();
		}
	}

    /**
     * Метод получения позиций, добавленных в корзину
     *
     * @return array
     */
	public function getProducts() {
            if (!$this->data) {
                foreach ($this->session->data['cart'] as $key => $quantity) {
                    $product_id = $key;

                    $product_query = $this->db->query("SELECT *, pd.name AS product_name, p2c.category_id AS category_id
                        FROM " . DB_PREFIX . "product p
                        INNER JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
                        INNER JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = p.product_id)
                        INNER JOIN " . DB_PREFIX . "category_description cd ON (cd.category_id = p2c.category_id)
                        WHERE p.product_id = '" . (int) $product_id . "'
                        AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'
                        AND p.date_available <= NOW() AND p.status = '1' AND p.in_stock = '1'");

                    if ($product_query->num_rows) {

                        $price = $product_query->row['price'];

                        // Product Specials
                        $product_special_query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_special
                                                WHERE product_id = '" . (int) $product_id . "'
                                                AND customer_group_id = '" . (int) $this->config->get('config_customer_group_id') . "'
                                                AND ((date_start = '0000-00-00' OR date_start < NOW())
                                                AND (date_end = '0000-00-00' OR date_end > NOW()))
                                                ORDER BY priority ASC, price ASC LIMIT 1");

                        if ($product_special_query->num_rows) {
                            $price = $product_special_query->row['price'];
                        }

                        $this->data[$key] = array(
                            'key' => $key,
                            'product_id' => $product_query->row['product_id'],
                            'name' => $product_query->row['product_name'],
                            'model' => $product_query->row['model'],
                            'image' => $product_query->row['image'],
                            'tax_class_id' => $product_query->row['tax_class_id'],
                            'quantity' => $quantity,
                            'price' => $price,
                            'total' => $price * $quantity
                        );
                    } else {
                        $this->remove($key);
                    }
                }
            }

            return $this->data;
	}

    /**
     * Метод добавления товара в корзину
     *
     * @param int $product_id
     * @param int $qty
     * @param string $size
     */
    public function add($product_id, $qty = 1, $size)
    {
        $this->data = array();

        $key = (int) $product_id;

        if ((int) $qty && ((int) $qty > 0)) {
            if (!isset($this->session->data['cart'][$key])) {
                $this->session->data['cart'][$key] = (int) $qty;
            } else {
                $this->session->data['cart'][$key] += (int) $qty;
            }

            $this->session->data['cart_size'][$key] = $size;
        }
    }

    /**
     * Метод обновления кол-ва позиции в корзине
     *
     * @param $key
     * @param $qty
     */
    public function update($key, $qty)
    {
        $this->data = array();

        if (isset($this->session->data['cart'][$key])) {
            $this->session->data['cart'][$key] += (int) $qty;
            if ($this->session->data['cart'][$key] == 0) {
                $this->session->data['cart'][$key] = 1;
            }
        }
    }

    /**
     * Метод очистки содержимого корзины
     */
    public function clear($order = false) {
        $this->data = array();

        $this->session->data['cart'] = array();
        $this->session->data['cart_size'] = array();

    }

    /**
     * Метод удаления товара из корзины
     * @param $key
     */
	public function remove($key) {
		$this->data = array();

		unset($this->session->data['cart'][$key]);
		unset($this->session->data['cart_size'][$key]);
	}

    /**
     * Метод получения итоговой суммы позиций в корзине
     *
     * @return int
     */
	public function getTotal() {
		$total = 0;

        foreach ($this->getProducts() as $product) {
            $total += $product['total'];
        }

		return $total;
	}

    /**
     * Метод получения кол-ва позиций в корзине
     *
     * @return int
     */
	public function countProducts() {
		$product_total = 0;

		$products = $this->getProducts();

		foreach ($products as $product) {
			$product_total += $product['quantity'];
		}

		return $product_total;
	}

    /**
     * Метод проверки корзины на пустоту
     *
     * @return int
     */
	public function hasProducts() {
		return count($this->session->data['cart']);
	}
}
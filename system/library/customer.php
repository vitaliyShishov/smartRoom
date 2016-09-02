<?php

/**
 * Класс для работы с клиентом
 *
 * PHP version 5.3
 */
class Customer
{
    private $customer_id;
    private $firstname;
    private $lastname;
    private $login;
    private $telephone;
    private $customer_group_id;
    private $approved;
    private $secondname;
    private $email;
    private $date_birth;
    private $city;
    private $warehouse;
    private $gender;
    private $own_referal;

    public function __construct($registry)
    {
        $this->config  = $registry->get('config');
        $this->db      = $registry->get('db');
        $this->request = $registry->get('request');
        $this->session = $registry->get('session');

        if (isset($this->session->data['customer_id'])) {
            $customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int) $this->session->data['customer_id'] . "' AND status = '1'");

            if ($customer_query->num_rows) {
                $this->customer_id       = $customer_query->row['customer_id'];
                $this->firstname         = $customer_query->row['firstname'];
                $this->lastname          = $customer_query->row['lastname'];
                $this->login             = $customer_query->row['telephone'];
                $this->telephone         = $customer_query->row['telephone'];
                $this->customer_group_id = $customer_query->row['customer_group_id'];
                $this->approved          = $customer_query->row['approved'];
                $this->secondname        = $customer_query->row['secondname'];
                $this->email             = $customer_query->row['email'];
                $this->date_birth        = $customer_query->row['date_birth'];
                $this->city              = $customer_query->row['city'];
                $this->warehouse         = $customer_query->row['warehouse'];
                $this->gender            = $customer_query->row['gender'];
                $this->own_referal       = $customer_query->row['own_referal'];

                $this->db->query("UPDATE " . DB_PREFIX . "customer SET cart = '" . $this->db->escape(isset($this->session->data['cart']) ? serialize($this->session->data['cart']) : '') . "', wishlist = '" . $this->db->escape(isset($this->session->data['wishlist']) ? serialize($this->session->data['wishlist']) : '') . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int) $this->customer_id . "'");

                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int) $this->session->data['customer_id'] . "' AND ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'");

                if (!$query->num_rows) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "customer_ip SET customer_id = '" . (int) $this->session->data['customer_id'] . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', date_added = NOW()");
                }
            } else {
                $this->logout();
            }
        }
    }

    public function login($login, $password, $override = false, $new = false, $social = false)
    {
        if ($override) {
            $customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE telephone = '" . $this->db->escape(utf8_strtolower($login)) . "' AND status = '1'");
        } else if ($new) {
            $customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE telephone = '" . $this->db->escape(utf8_strtolower($login)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1'");
        } else if ($social) {
            $customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE telephone = '" . $this->db->escape(utf8_strtolower($login)) . "' AND password = '" . $this->db->escape($password) . "' AND status = '1' AND approved = '1'");
        } else {
            $customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE telephone = '" . $this->db->escape(utf8_strtolower($login)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1' AND approved = '1'");
        }

        if ($customer_query->num_rows) {
            $this->session->data['customer_approve']['one'] = $login;
            $this->session->data['customer_approve']['two'] = $password;
            $this->session->data['customer_id'] = $customer_query->row['customer_id'];

            if ($customer_query->row['cart'] && is_string($customer_query->row['cart'])) {
                $cart = unserialize($customer_query->row['cart']);

                foreach ($cart as $key => $value) {
                    if (!array_key_exists($key, $this->session->data['cart'])) {
                        $this->session->data['cart'][$key] = $value;
                    } else {
                        $this->session->data['cart'][$key] += $value;
                    }
                }
            }

            if ($customer_query->row['wishlist'] && is_string($customer_query->row['wishlist'])) {
                if (!isset($this->session->data['wishlist'])) {
                    $this->session->data['wishlist'] = array();
                }

                $wishlist = unserialize($customer_query->row['wishlist']);

                foreach ($wishlist as $product_id) {
                    if (!in_array($product_id, $this->session->data['wishlist'])) {
                        $this->session->data['wishlist'][] = $product_id;
                    }
                }
            }

            $this->customer_id       = $customer_query->row['customer_id'];
            $this->firstname         = $customer_query->row['firstname'];
            $this->lastname          = $customer_query->row['lastname'];
            $this->login             = $customer_query->row['telephone'];
            $this->telephone         = $customer_query->row['telephone'];
            $this->customer_group_id = $customer_query->row['customer_group_id'];
            $this->approved          = $customer_query->row['approved'];
            $this->secondname        = $customer_query->row['secondname'];
            $this->email             = $customer_query->row['email'];
            $this->date_birth        = $customer_query->row['date_birth'];
            $this->city              = $customer_query->row['city'];
            $this->warehouse         = $customer_query->row['warehouse'];
            $this->gender            = $customer_query->row['gender'];
            $this->own_referal       = $customer_query->row['own_referal'];

            $this->db->query("UPDATE " . DB_PREFIX . "customer SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int) $this->customer_id . "'");

            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        $this->db->query("UPDATE " . DB_PREFIX . "customer SET cart = '" . $this->db->escape(isset($this->session->data['cart']) ? serialize($this->session->data['cart']) : '') . "', wishlist = '" . $this->db->escape(isset($this->session->data['wishlist']) ? serialize($this->session->data['wishlist']) : '') . "' WHERE customer_id = '" . (int) $this->customer_id . "'");

        unset($this->session->data['customer_id']);

        $this->customer_id       = '';
        $this->firstname         = '';
        $this->lastname          = '';
        $this->login             = '';
        $this->telephone         = '';
        $this->customer_group_id = '';
        $this->approved          = '';
        $this->secondname        = '';
        $this->email             = '';
        $this->date_birth        = '';
        $this->city              = '';
        $this->warehouse         = '';
        $this->gender            = '';
        $this->own_referal       = '';
    }

    public function updateCart()
    {
        $this->db->query("UPDATE " . DB_PREFIX . "customer SET cart = '" . $this->db->escape(isset($this->session->data['cart']) ? serialize($this->session->data['cart']) : '') . "'
            WHERE customer_id = '" . (int) $this->customer_id . "'");
    }

    /**
     * Метод для обновления списка желаний в БД
     */
    public function updateWishList()
    {

        $wishlist_array = $this->db->query("SELECT wishlist FROM " . DB_PREFIX . "customer 
            WHERE customer_id = '" . (int) $this->customer_id . "'");
        $wishlist       = unserialize($wishlist_array->row['wishlist']);

        if(!$wishlist){
            $wishlist = array();
        }

        if (isset($this->session->data['wishlist'])) {
            $wishlist = $wishlist + $this->session->data['wishlist'];
        }

        if (isset($this->request->cookie['wish_list'])) {
            $wishlist = $wishlist + json_decode(html_entity_decode($this->request->cookie['wish_list']));
        }

        $this->db->query("UPDATE " . DB_PREFIX . "customer SET wishlist = '" . $this->db->escape(serialize($wishlist)) . "'
            WHERE customer_id = '" . (int) $this->customer_id . "'");
    }

    /**
     * Метод добавляет товары, которыми клиент поделился в социальных сетях
     */
    public function updateRepost()
    {
        if (isset($this->session->data['repost'])) {
            $exist = $this->db->query("SELECT repost "
                . "FROM " . DB_PREFIX . "customer "
                . "WHERE customer_id = '" . (int) $this->customer_id . "'");

            if ($exist->row['repost']) {
                $repost = unserialize($exist->row['repost']) + $this->session->data['repost'];
            } else {
                $repost = $this->session->data['repost'];
            }

            $this->db->query("UPDATE " . DB_PREFIX . "customer "
                . "SET repost = '" . $this->db->escape(serialize($repost)) . "' "
                . "WHERE customer_id = '" . (int) $this->customer_id . "'");
        }
    }

    public function isLogged()
    {
        return $this->customer_id;
    }

    public function getId()
    {
        return $this->customer_id;
    }

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getGroupId()
    {
        return $this->customer_group_id;
    }

    public function getApproved()
    {
        return $this->approved;
    }

    public function getSecondName()
    {
        return $this->secondname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getCity()
    {
        return $this->city;
    }

    /**
     * Метод получения склада
     * 
     * @return string
     */
    public function getWarehouse()
    {
        return $this->warehouse;
    }

    public function getDateBirth()
    {
        return $this->date_birth;
    }

    public function getOwnReferal()
    {
        return $this->own_referal;
    }

    public function getBalance()
    {
        $query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int) $this->customer_id . "'");

        return $query->row['total'];
    }

    public function getRewardPoints()
    {
        $query = $this->db->query("SELECT SUM(points) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int) $this->customer_id . "'");

        return $query->row['total'];
    }
}
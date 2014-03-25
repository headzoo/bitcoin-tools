<?php
namespace Headzoo\Bitcoin\Tools;

/**
 * Validates Bitcoin addresses
 *
 * Code copied from http://pastebin.com/nvmQJBAm
 */
class Validator
{
    /**
     * Byte for livenet version
     */
    const VERSION_LIVENET = "00";

    /**
     * Byte for testnet version
     */
    const VERSION_TESTNET = "6F";

    /**
     * Network version, hex byte
     *
     * @var string
     */
    public $addressversion = self::VERSION_LIVENET;

    /**
     * Constructor
     *
     * @param bool $testnet Validate addresses for testnet?
     */
    public function __construct($testnet = false)
    {
        $this->addressversion = ($testnet)
            ? self::VERSION_TESTNET
            : self::VERSION_LIVENET;
    }

    /**
     * Returns whether the given value is a valid Bitcoin address
     *
     * @param string $address The address to validate
     * @return bool
     */
    public function isValid($address)
    {
        $address = $this->decodeBase58($address);
        if (strlen($address) != 50) {
            return false;
        }

        $version = substr($address, 0, 2);
        if (hexdec($version) != hexdec($this->addressversion)) {
            return false;
        }

        $check = substr($address, 0, strlen($address) - 8);
        $check = pack("H*", $check);
        $check = strtoupper(hash("sha256", hash("sha256", $check, true)));
        $check = substr($check, 0, 8);

        return $check == substr($address, strlen($address) - 8);
    }

    /**
     * Decode a dec value to hex
     *
     * @param string $dec The dec value
     * @return string
     */
    private function encodeHex($dec)
    {
        $chars  = "0123456789ABCDEF";
        $return = "";
        while (bccomp($dec, 0) == 1) {
            $dv     = (string)bcdiv($dec, "16", 0);
            $rem    = (integer)bcmod($dec, "16");
            $dec    = $dv;
            $return = $return . $chars[$rem];
        }

        return strrev($return);
    }

    /**
     * Decodes a base58 encoded string
     *
     * @param string $base58 The base58 encoded string
     * @return string
     */
    private function decodeBase58($base58)
    {
        $orig = $base58;

        $chars  = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
        $return = "0";
        for ($i = 0; $i < strlen($base58); $i++) {
            $current = (string)strpos($chars, $base58[$i]);
            $return  = (string)bcmul($return, "58", 0);
            $return  = (string)bcadd($return, $current, 0);
        }

        $return = $this->encodeHex($return);
        for ($i = 0; $i < strlen($orig) && $orig[$i] == "1"; $i++) {
            $return = "00" . $return;
        }
        if (strlen($return) % 2 != 0) {
            $return = "0" . $return;
        }

        return $return;
    }
}
<?php
/**
 * Custom Unit of Measurement  Helper
 *
 * This helper provides support with
 * formatting and displaying unit of
 * measurements
 *
 */

//------------------------------------------------

if (! function_exists('uom_formatter'))
{
    /**
     * Displays unit of measurement in singular or
     * plural based on quantity and selected unit
     *
     * @param string $name   Name of the item
     * @param int $quantity  Quantity of the item
     * @param string $uom    Unit of measurement
     *
     * @return string
     */
    function uom_formatter(string $name, int $quantity, string $uom): string
    {
        helper('inflector');
        $formatted_uom = '';

        if ($quantity == 0 || $quantity > 1) {
            if (strtolower($uom) === 'none') {
                $formatted_uom = ucwords(plural($name));
            } else {
                $formatted_uom = ucwords(plural($uom));
            }
        } else {
            if (strtolower($uom) === 'none') {
                $formatted_uom = ucwords(singular($name));
            } else {
                $formatted_uom = ucwords(singular($uom));
            }
        }

        return $formatted_uom;
    }
}
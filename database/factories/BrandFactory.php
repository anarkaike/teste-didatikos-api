<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = [
            'Apple', 'Samsung', 'Microsoft', 'Google', 'Sony', 'Dell', 'HP', 'Lenovo', 'Asus', 'Acer',
            'Intel', 'AMD', 'Nvidia', 'IBM', 'Canon', 'Nikon', 'Sony', 'Panasonic', 'LG', 'Sharp',
            'Bose', 'JBL', 'Beats', 'Philips', 'Logitech', 'Corsair', 'Razer', 'Adobe', 'Autodesk', 'Oracle',
            'Cisco', 'Linksys', 'TP-Link', 'Netgear', 'D-Link', 'Western Digital', 'Seagate', 'SanDisk', 'Kingston', 'Crucial',
            'Epson', 'Brother', 'Xerox', 'Fujitsu', 'Siemens', 'Hewlett-Packard', 'Xiaomi', 'OnePlus', 'OPPO', 'Vivo',
            'Blackberry', 'HTC', 'Motorola', 'Nokia', 'Siemens', 'Alcatel', 'ZTE', 'Huawei', 'Cisco', 'Juniper',
            'VMware', 'Red Hat', 'Ubuntu', 'Debian', 'CentOS', 'Fedora', 'Kaspersky', 'McAfee', 'Symantec', 'Bitdefender',
            'Facebook', 'Twitter', 'Instagram', 'LinkedIn', 'Snapchat', 'Pinterest', 'TikTok', 'YouTube', 'WhatsApp', 'Telegram',
            'Netflix', 'Hulu', 'Amazon', 'Disney', 'Spotify', 'Apple Music', 'Google Play Music', 'Microsoft Teams', 'Zoom', 'Slack',
            'WordPress', 'Joomla', 'Drupal', 'Magento', 'Shopify', 'Wix', 'Squarespace', 'Weebly', 'GoDaddy', 'Bluehost'
        ];
        return [
            'name' => $name = $brands[array_rand($brands)],
            'manufacturer' => $name,
        ];
    }
}

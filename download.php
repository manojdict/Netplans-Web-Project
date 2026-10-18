<?php
require 'includes/db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$order_id = $_GET['order_id'] ?? 0;
$user_id = $_SESSION['user_id'];

// Check if this user legitimately owns this completed order
$stmt = $pdo->prepare('SELECT o.*, p.title, p.category, p.image FROM orders o JOIN plans p ON o.plan_id = p.id WHERE o.id = ? AND o.user_id = ?');
$stmt->execute([$order_id, $user_id]);
$order = $stmt->fetch();

if (!$order) {
    die('Unauthorized access: You do not own a licensed copy of this blueprint or the order is invalid.');
}

// Generate an official NetPlans Blueprint Package text/spec file for download
$filename = 'NetPlans_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $order['title']) . '_Package.txt';

header('Content-Type: text/plain; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');

echo "========================================================================\n";
echo "NETPLANS ENTERPRISE NETWORK ARCHITECTURE SPECIFICATION PACKAGE\n";
echo "========================================================================\n\n";
echo "License ID        : NP-LIC-" . strtoupper(substr(md5($order['id'] . $order['created_at']), 0, 12)) . "\n";
echo "Customer Name     : " . ($_SESSION['user_name'] ?? 'Engineer') . "\n";
echo "Blueprint Title   : " . $order['title'] . "\n";
echo "Category          : " . $order['category'] . "\n";
echo "Purchase Date     : " . $order['created_at'] . "\n";
echo "Compliance Status : IEEE 802.1Q / Zero-Trust Architecture Certified\n\n";
echo "------------------------------------------------------------------------\n";
echo "TOPOLOGY DESIGN SPECIFICATIONS AND IP ALLOCATION MATRIX:\n";
echo "------------------------------------------------------------------------\n";
echo "1. Core Layer     : 2x 10Gbps Multi-Chassis EtherChannel (MCLAG / vPC)\n";
echo "2. Distribution   : Layer 3 Core-Spine Architecture with OSPF Area 0\n";
echo "3. Access Switches: IEEE 802.1w Rapid Spanning Tree + 802.1X Port Security\n";
echo "4. VLAN Structure :\n";
echo "   - VLAN 10 (Management)     : 10.10.10.0/24 (Gateway: 10.10.10.1)\n";
echo "   - VLAN 20 (Corporate LAN)  : 10.10.20.0/24 (Gateway: 10.10.20.1)\n";
echo "   - VLAN 30 (Servers/Data)   : 10.10.30.0/24 (Gateway: 10.10.30.1)\n";
echo "   - VLAN 40 (VoIP Telephony) : 10.10.40.0/24 (Gateway: 10.10.40.1, QoS CoS 5)\n";
echo "   - VLAN 99 (Isolated Guest) : 192.168.99.0/24 (Captive Portal / DMZ)\n\n";
echo "5. Firewall Policy: Next-Gen Dual-Homed Redundant Inspection (Active/Passive HA)\n\n";
echo "========================================================================\n";
echo "Thank you for partnering with NetPlans. For custom modifications or CAD/Visio\n";
echo "deliverable queries, contact our architects at support@netplans.internal\n";
echo "========================================================================\n";
exit();
<?php

namespace SMARTONE\UserBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array(
            'childrenAttributes'    => array(
                'class'             => 'nav',
            ),
        ));

        $menu->addChild('Home', array(
            'extras' => array('safe_label' => true),
            'route' => 'dashboard',
            'class' => 'sidenav-item',
            'label' => '<span class="nav-icon"><i class="fa fa-dashboard"></i></span><span class="nav-text">Dashboard</span>',
            'linkAttributes' => array('class' => 'block-list__link'),
        ));


        $menu->addChild('Order Received',
            array(
                'extras' => array('safe_label' => true),
                'route' => 'order',
                'class' => 'sidenav-item',
                'label' => '<span class="nav-icon"><i class="fa fa-clock-o"></i></span><span class="nav-text">Order Received</span>',
                'linkAttributes' => array('class' => 'block-list__link'),
            )
        );

        $menu->addChild('Scheduled Orders',
            array(
                'extras' => array('safe_label' => true),
                'route' => 'schedule',
                'class' => 'sidenav-item',
                'label' => '<span class="nav-icon"><i class="fa fa-clock-o"></i></span><span class="nav-text">Scheduled Orders</span>',
                'linkAttributes' => array('class' => 'block-list__link'),
            )
        );
//
        $menu->addChild('Completed Orders',
            array(
                'extras' => array('safe_label' => true),
                'route' => 'completed',
                'class' => 'sidenav-item',
                'label' => '<span class="nav-icon"><i class="fa fa-check"></i></span><span class="nav-text">Completed</span>',
                'linkAttributes' => array('class' => 'block-list__link'),
            )
        );

        $menu->addChild('Cancelled Orders',
            array(
                'extras' => array('safe_label' => true),
                'route' => 'orders_cancelled',
                'class' => 'sidenav-item',
                'label' => '<span class="nav-icon"><i class="fa fa-times"></i></span><span class="nav-text">Cancelled / On Hold</span>',
                'linkAttributes' => array('class' => 'block-list__link'),
            )
        );

        $menu->addChild('new_order',
            array(
                'extras' => array('safe_label' => true),
                'route' => 'order_new',
                'class' => 'sidenav-item',
                'label' => '<span class="nav-icon"><i class="fa fa-plus"></i></span><span class="nav-text">New Order</span>',
                'linkAttributes' => array('class' => 'block-list__link'),
            )
        );

        $menu->addChild('Schedules',
            array(
                'extras' => array('safe_label' => true),
                'route' => 'docorder',
                'class' => 'sidenav-item',
                'label' => '<span class="nav-icon"><i class="fa fa-tasks"></i></span><span class="nav-text">Schedules</span>',
                'linkAttributes' => array('class' => 'block-list__link'),
            )
        );

 $menu->addChild('Addresses',
            array(
                'extras' => array('safe_label' => true),
                'route' => 'orderaddress',
                'class' => 'sidenav-item',
                'label' => '<span class="nav-icon"><i class="fa fa-tasks"></i></span><span class="nav-text">Addresses</span>',
                'linkAttributes' => array('class' => 'block-list__link'),
            )
        );

        $menu->addChild('news',
            array(
                'extras' => array('safe_label' => true),
                'route' => 'ordernews',
                'class' => 'sidenav-item',
                'label' => '<span class="nav-icon"><i class="fa fa-tasks"></i></span><span class="nav-text">Order News</span>',
                'linkAttributes' => array('class' => 'block-list__link'),
            )
        );

//        $menu->addChild('new_doc',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'docorder_new',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-plus"></i></span><span class="nav-text">New Schedule</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu->addChild('Live',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'live_screen',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="material-icons md-24"></i></span><span class="nav-text">Live Screen</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu->addChild('Label',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'shipment',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-barcode"></i></span><span class="nav-text">Create Label</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu->addChild('Sale',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'sale',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-table"></i></span><span class="nav-text">Sales</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu->addChild('Production',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'productionitem',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="material-icons"></i></span><span class="nav-text">Production</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('basecategory',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'basecategory',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Base Categories</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('base',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'base',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Bases</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('mattress',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'mattress',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Mattresses</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('mattressfilling',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'mattressfilling',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Mattresses Filling</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('mattressquiltdesign',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'mattressquiltdesign',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Mattresses Quilt Design</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('mattresslabel',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'mattresslabel',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Mattresses Label</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('headboard',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'headboard',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Headboard</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('mattressCover',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'mattresscover',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Mattress Cover</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('fabricColour',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'fabriccolour',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Fabric Colour</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('feet',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'feet',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Feet</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('badge',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'badge',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Badge</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('bedAction',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'bedaction',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Bed Actions</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('handset',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'handset',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Handset</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('endbar',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'endbar',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">End Bar</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('preset',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'preset',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Preset</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Production']->addChild('presetfabriccolour',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'presetfabriccolour',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cog"></i></span><span class="nav-text">Preset Fabric Colours</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu->addChild('Customer',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'customer',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-user"></i></span><span class="nav-text">Customers</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu->addChild('Reports',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'report',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="material-icons"></i></span><span class="nav-text">Reports</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu->addChild('Settings',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'info',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-cogs"></i></span><span class="nav-text">Settings</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Settings']->addChild('Brands',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'brand',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-server"></i></span><span class="nav-text">Brands</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Settings']->addChild('Couriers',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'courier',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-truck"></i></span><span class="nav-text">Couriers</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Settings']->addChild('Vehicle',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'vehicle',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-truck"></i></span><span class="nav-text">Vehicles</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Settings']->addChild('Sizes',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'size',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="material-icons"></i></span><span class="nav-text">Sizes</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Settings']->addChild('Users',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'user',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="material-icons"></i></span><span class="nav-text">Users</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Settings']->addChild('Info',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'info',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-info"></i></span><span class="nav-text">Info</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Settings']->addChild('Question',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'question',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-question"></i></span><span class="nav-text">Questions</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu['Settings']->addChild('Answer',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'answer',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-exclamation"></i></span><span class="nav-text">Answers</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        return $menu;
//    }
//
//    public function userMenu(FactoryInterface $factory, array $options)
//    {
//        $menu = $factory->createItem('root', array(
//            'childrenAttributes'    => array(
//                'class'             => 'nav',
//            ),
//        ));
//
//        $menu->addChild('Home', array(
//            'extras' => array('safe_label' => true),
//            'route' => 'dashboard',
//            'class' => 'sidenav-item',
//            'label' => '<span class="nav-icon"><i class="fa fa-dashboard"></i></span><span class="nav-text">Dashboard</span>',
//            'linkAttributes' => array('class' => 'block-list__link'),
//        ));
//
//        $menu->addChild('Couriers',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'courier',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-truck"></i></span><span class="nav-text">Couriers</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu->addChild('Sizes',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'size',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="material-icons"></i></span><span class="nav-text">Sizes</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );
//
//        $menu->addChild('Shipments',
//            array(
//                'extras' => array('safe_label' => true),
//                'route' => 'shipment',
//                'class' => 'sidenav-item',
//                'label' => '<span class="nav-icon"><i class="fa fa-barcode"></i></span><span class="nav-text">Shipments</span>',
//                'linkAttributes' => array('class' => 'block-list__link'),
//            )
//        );

        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array(
            'childrenAttributes'    => array(
                'class'             => 'nav',
            ),
        ));

        $menu->addChild('Home', array(
            'extras' => array('safe_label' => true),
            'route' => 'dashboard',
            'class' => 'sidenav-item',
            'label' => '<span class="nav-icon"><i class="fa fa-dashboard"></i></span><span class="nav-text">Dashboard</span>',
            'linkAttributes' => array('class' => 'block-list__link'),
        ));


        $menu->addChild('Order Received',
            array(
                'extras' => array('safe_label' => true),
                'route' => 'order',
                'class' => 'sidenav-item',
                'label' => '<span class="nav-icon"><i class="fa fa-clock-o"></i></span><span class="nav-text">Order Received</span>',
                'linkAttributes' => array('class' => 'block-list__link'),
            )
        );

        $menu->addChild('Scheduled Orders',
            array(
                'extras' => array('safe_label' => true),
                'route' => 'schedule',
                'class' => 'sidenav-item',
                'label' => '<span class="nav-icon"><i class="fa fa-clock-o"></i></span><span class="nav-text">Scheduled Orders</span>',
                'linkAttributes' => array('class' => 'block-list__link'),
            )
        );
//
        $menu->addChild('Completed Orders',
            array(
                'extras' => array('safe_label' => true),
                'route' => 'completed',
                'class' => 'sidenav-item',
                'label' => '<span class="nav-icon"><i class="fa fa-check"></i></span><span class="nav-text">Completed</span>',
                'linkAttributes' => array('class' => 'block-list__link'),
            )
        );

        $menu->addChild('Cancelled Orders',
            array(
                'extras' => array('safe_label' => true),
                'route' => 'orders_cancelled',
                'class' => 'sidenav-item',
                'label' => '<span class="nav-icon"><i class="fa fa-times"></i></span><span class="nav-text">Cancelled / On Hold</span>',
                'linkAttributes' => array('class' => 'block-list__link'),
            )
        );

        return $menu;
    }
}
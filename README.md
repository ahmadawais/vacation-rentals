#VRCore `v0.0.8`
[Work in progress!] Add vacation rentals to your WordPress site with membership, agents, partners, search, and frontend booking features.

![](https://i.imgur.com/hV31YF3.png)

##Architecture
- `vr-core.php`: Main plugin file that includes `vrc.php`
- `vrc.php`: Main initializer for everything

###Design Pattern
Let's assume we are building a functionality called `feature`
- Folder: `feature` 
- File: `feature-init.php` includes everything classes and actions/filters
- File: `class-feature.php` main class that interacts with other small classes
- File: `cpt-feature.php` class for the Custom Post Type
- File: `ct-feature-taxonomy.php` class for the custom taxonomy
- File: `feature-custom` a custom class for a sub-feature
- File: `class-feature-meta-boxes` class for related meta boxes

# vacation-rentals

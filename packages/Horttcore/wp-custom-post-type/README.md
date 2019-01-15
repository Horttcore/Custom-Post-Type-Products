# Custom Post Type Helper Class

## Installation

`composer require Horttcore\CustomPostType`

## Usage

Extend the abstract class `PostType` and overwrite following methods:

* `getConfig()`
* `getLabels()`
* `getPostUpdateMessage( WP_Post $post, string $postType, WP_Post_Type $postTypeObjects )`

The extending class _MUST_ define class constant `SLUG`
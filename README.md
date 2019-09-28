# mo2o

## API endpoints

##### Note: required parameters are marked with `*`

### Get Recipes

Get the list of `recipes` paginated. 

**`GET` `/api/v1/recipes`**

Request Body:

- **`search `**: The keyword for recipes filter.
- **`page `**: The page we want to show (10 elements per page).
  
Response:

```json
{
    "results": [
            {
                "title": "Lore Ipsum",
                "href": "http://therecipewebpage.example"
            },
            {
                "title": "Lore Ipsum",
                "href": "http://therecipewebpage.example"
            }
            //List of recipes... 
     ]
}
```

### Get Recipes Detail

Get a list of `recipes` paginated with detailed information. 

**`GET` `/api/v1/recipes/detail`**

Request Body:

- **`ingredients `**: Comma delimited list of ingredients (i.e.: `tomato,onions,garlic`).
- **`page `**: The page we want to show (10 elements per page).
  
Response:

```json
{
    "results": [
            {
                "title": "Lore Ipsum",
                "ingredients": "cannellini beans, tomato, basil, garlic, onions",
                "thumbnail": "http://img.exmple.com/555909.jpg"
            },
            {
                "title": "Lore Ipsum",
                "ingredients": "garlic, olive oil, onions, salt, tomato",
                "thumbnail": "http://img.exmple.com/555909.jpg"
            }
            //List of recipes... 
     ]
}
```

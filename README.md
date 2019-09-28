# mo2o

## API endpoints


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

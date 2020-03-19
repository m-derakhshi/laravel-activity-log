# Pocket data 
pocket data is package server side rendering for fetch multi route  

## Installation
```text
composer require mderakhshi/pocket-data --no-cache
```

## Usage:
    route : {laravelPath}/logLiner/
    method : POST
    parameters: json
    
###  Structure:

#####  parameters json:
```json
{
    "routes":{
        "${route.key}":{
            "url":"${route.path}",
            "method":"(get|post|put|patch|delete)", 
            "parameters":{"object":"object"}
        }
    }
}
```
> Default method: get

> Default parameters: []


##### Response:
```json
{
    "${route.key}":"${route.content}"
}
```

###  Example 

##### parameters json:
```json
{
    "routes":{
        "api.user.update.1":{
            "url":"/api/user/1/",
            "method":"patch",
            "parameters":{
                "name": "masoud",
                "last_name": "derakhshi"
            }
        },
        "api.user.delete.2":{
            "url":"/api/user/2/",
            "method":"delete"
        },
        "api.user.get.3":{
            "url":"/api/user/3/"
        }
    }
}
```

##### Response:
```json
{
    "api.user.update.1": {
        "id": "1",
        "name": "masoud",
        "last_name": "derakhshi",
        "updated_at": "2020/01/01 12:00:00"
    },
    "api.user.delete.2": true,
    "api.user.get.3": {
        "id": "3",
        "name": "masoud",
        "last_name": "derakhshi",
        "created_at": "2020/01/01 12:00:00",
        "updated_at": "2020/01/01 12:00:00"
    }
}
```

## License
[MIT](https://choosealicense.com/licenses/mit/)

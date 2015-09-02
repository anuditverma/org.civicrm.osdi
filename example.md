# Example

## Here are some examples to work with actions like POST, PUT and DELETE.

## POST
### Currently the acceptable JSON format for POST-ing the data through person-sign up helper is defined below:

```json
{
"given_name":"John","additional_name":"","family_name":"Smith","gender":"Male","postal_addresses":"Testfieldspacing","email":"jsmith@mail.com","phone":12345
}
```
## PUT
### Similarly to Update (PUT) the data, use NON-GET self link request button on the person's endpoint and provide 'Method' as PUT.
### Provide the fields you want to update for that contact.

```json
{
"given_name":"Sherlock","family_name":"Homes"
}
```

## DELETE
### To remove an individual resource, just use NON-GET self link request button on the person's endpoint and provide 'Method' as DELETE.





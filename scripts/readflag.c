#include <stdio.h>
#include <stdlib.h>

int main() {
    FILE *file;
    char buffer[64];

    file = fopen("/flag.txt", "r");
    if (file == NULL) {
        perror("Error opening file");
        return EXIT_FAILURE;
    }

    while (fgets(buffer, sizeof(buffer), file) != NULL) {
        printf("%s", buffer);
    }

    fclose(file);
    return EXIT_SUCCESS;
}

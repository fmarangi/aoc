from math import sqrt

def is_prime(num):
    if (num > 2 and num % 2 == 0) or num == 1:
        return False
    i, max = 3, sqrt(num)
    while i <= max:
        if num % i == 0:
            return False
        i += 2
    return True

def simplify():
    b, c, h = 109300, 126300, 0
    for n in range(b, c + 1, 17):
        if not(is_prime(n)):
            h += 1
    return h

def run_instructions(a=0):
    b = c = d = e = f = g = h = 0

    b = c = 93
    if a:
        b = 109300
        c = 126300

    while True:
        f = 1
        d = 2
        while True:
            e = 2
            while True:
                g = d * e - b
                if not(g):
                    f = 0
                e += 1
                g = e - b
                if not(g):
                    break
            d += 1
            g = d - b
            if not(g):
                break
        if not(f):
            h += 1
        g = b - c
        if not(g):
            break
        b += 17

    return h

print simplify()
print run_instructions(1)

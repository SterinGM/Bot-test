FROM postgres

COPY pg_bot-test.conf /docker-entrypoint-initdb.d

# Copy pg_hba.conf to PGDATA directory
RUN echo "cp /docker-entrypoint-initdb.d/pg_bot-test.conf /var/lib/postgresql/data/pgdata/" > /docker-entrypoint-initdb.d/pg_bot-test.sh